<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cause;
use App\Models\CausePhoto;
use App\Models\CauseVideo;
use App\Models\CauseFaq;
use App\Models\CauseDonation;
use App\Models\Admin;
use App\Mail\Websitemail;
use App\Models\Photo;
use App\Models\User;
use App\Models\Video;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CauseController extends Controller
{
    public function index()
    {
        $causes = Cause::orderBy('id', 'desc')->where('is_featured','yes')->with('orphans')->paginate(15);
        return view('front.causes', compact('causes'));
    }

    public function show($slug)
    {
        $cause = Cause::where('slug', $slug)->first();
        $causePhotos = CausePhoto::where('cause_id',$cause->id)->get();
        $causeVideos = CauseVideo::where('cause_id',$cause->id)->get();
        $causeFaqs = CauseFaq::where('cause_id',$cause->id)->get();
        // $recentCauses = Cause::orderBy('id', 'desc')->where('is_featured','yes')->take(5)->get();
        return view('front.cause', compact('cause', 'causePhotos', 'causeVideos', 'causeFaqs'));
    }

    // public function sendMessage(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'message' => 'required'
    //     ]);

    //     $admin_data = Admin::where('id',1)->first();
    //     $admin_email = $admin_data->email;

    //     $cause_data = Cause::where('id',$request->cause_id)->first();

    //     $subject = "Message from visitor for Cause - ".$cause_data->name;
    //     $message = "<b>Visitor Information:</b><br><br>";
    //     $message .= "Name: ".$request->name."<br>";
    //     $message .= "Email: ".$request->email."<br>";
    //     $message .= "Phone: ".$request->phone."<br>";
    //     $message .= "Message: ".$request->message."<br><br>";
    //     $message .= "<b>Cause Page URL: </b><br>";
    //     $message .= "<a href='".url('/cause/'.$cause_data->slug)."'>".url('/cause/'.$cause_data->slug)."</a>";

    //     Mail::to($admin_email)->send(new Websitemail($subject,$message));

    //     return redirect()->back()->with('success','Message sent successfully');
    // }

    public function donate($slug = null)
    {
        $cause = Cause::where('slug', $slug)->first();
        // dd($cause->id);
        return view('front.donate', compact('cause'));
    }


    public function payment(Request $request)
    {
        // if(!auth()->user()) {
        //     return redirect()->route('login');
        // }

        $request->validate([
            'cause_id' => 'nullable|exists:causes,id',
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:1'],
            'donation_type' => 'required|in:one_time,monthly',
            'payment_method' => 'required|in:paypal,stripe'
        ]);

        $cause_data = $request->cause_id ? Cause::where('id',$request->cause_id)->first() : null;
        // dd($cause_data);
        $needed_amount = $cause_data ? $cause_data->goal - $cause_data->raised : null;

        if(isset($needed_amount) && $request->price > $needed_amount) {
            return redirect()->back()->with('error','You can not donate more than needed amount');
        }

        $donationType = $request->donation_type;

        if($request->payment_method == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            if ($donationType == 'one_time') {
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('donation.payment.paypal'),
                        "cancel_url" => route('donation.payment.cancel')
                    ],
                    "purchase_units" => [
                        [
                            "amount" => [
                                "currency_code" => "USD",
                                "value" => $request->price
                            ]
                        ]
                    ]
                ]);
                //dd($response);
                if(isset($response['id']) && $response['id']!=null) {
                    foreach($response['links'] as $link) {
                        if($link['rel'] === 'approve') {
                            if(isset($request->cause_id)) {
                                session()->put('cause_id', $request->cause_id);
                            }
                            session()->put('name', $request->name);
                            session()->put('email', $request->email);
                            session()->put('address', $request->address);
                            session()->put('phone', $request->phone);
                            session()->put('price', $request->price);
                            session()->put('donation_type', $donationType);
                            return redirect()->away($link['href']);
                        }
                    }
                } else {
                    return redirect()->route('donation.payment.cancel');
                }
            } elseif ($donationType == 'monthly') {
                // Monthly Subscription via PayPal
                // Note: PayPal requires predefined billing plans. Ensure you've created a plan in PayPal Dashboard.
    
                // Replace 'YOUR_PLAN_ID' with the actual plan ID from PayPal
                $plan_id = 'YOUR_PLAN_ID'; 
    
                $response = $provider->createSubscription([
                    'plan_id' => $plan_id,
                    'application_context' => [
                        'return_url' => route('donation.payment.paypal'),
                        'cancel_url' => route('donation.payment.cancel'),
                    ],
                ]);
    
                if (isset($response['id']) && $response['id'] != null) {
                    foreach ($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {
                            if(isset($request->cause_id)) {
                                session()->put('cause_id', $request->cause_id);
                            }
                            session()->put('name', $request->name);
                            session()->put('email', $request->email);
                            session()->put('address', $request->address);
                            session()->put('phone', $request->phone);
                            session()->put('price', $request->price);
                            session()->put('donation_type', $donationType);
                            return redirect()->away($link['href']);
                        }
                    }
                } else {
                    return redirect()->route('donation.payment.cancel');
                }
            }
        }

        if($request->payment_method == 'stripe') {
            $stripe = new \Stripe\StripeClient(config: config('stripe.stripe_sk'));

            if ($donationType == 'one_time') {
                $response = $stripe->checkout->sessions->create([
                    'line_items' => [
                        [
                            'price_data' => [
                                'currency' => 'usd',
                                'product_data' => [
                                    'name' => $cause_data->name ?? 'One Time Donation',
                                ],
                                'unit_amount' => $request->price*100,
                            ],
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment',
                    'success_url' => route('donation.payment.stripe').'?session_id={CHECKOUT_SESSION_ID}&cause_id=' . $request->cause_id,
                    'cancel_url' => route('donation.payment.cancel'),
                ]);
                //dd($response);
                if(isset($response->id) && $response->id != ''){
                    if(isset($request->cause_id)) {
                        session()->put('cause_id', $request->cause_id);
                    }
                    session()->put('name', $request->name);
                    session()->put('email', $request->email);
                    session()->put('address', $request->address);
                    session()->put('phone', $request->phone);
                    session()->put('price', $request->price);
                    session()->put('donation_type', $donationType);
                    return redirect($response->url);
                } else {
                    return redirect()->route('donation.payment.cancel');
                }
            } elseif ($donationType == 'monthly') {
                \Stripe\Stripe::setApiKey(config('stripe.stripe_sk'));
                // Monthly Subscription via Stripe
    
                // Create a product for the subscription
                $product = \Stripe\Product::create([
                    'name' => session()->put('name') . ' Monthly Donation' ?? 'Monthly Donation',
                    'type' => 'service',
                ]);
    
                // Create a price for the subscription
                $priceData = \Stripe\Price::create([
                    'unit_amount' => $request->price * 100,
                    'currency' => 'usd',
                    'recurring' => ['interval' => 'month'],
                    'product' => $product->id,
                ]);
    
                // Create Checkout Session for Subscription
                $response = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                        'price' => $priceData->id,
                        'quantity' => 1,
                    ]],
                    'mode' => 'subscription',
                    'success_url' => route('donation.payment.stripe') . '?session_id={CHECKOUT_SESSION_ID}',
                    'cancel_url' => route('donation.payment.cancel'),
                ]);
    
                if (isset($response->id) && $response->id != '') {
                    if(isset($request->cause_id)) {
                        session()->put('cause_id', $request->cause_id);
                    }
                    session()->put('name', $request->name);
                    session()->put('email', $request->email);
                    session()->put('address', $request->address);
                    session()->put('phone', $request->phone);
                    session()->put('price', $request->price);
                    session()->put('donation_type', $donationType);
                    return redirect($response->url);
                } else {
                    return redirect()->route('donation.payment.cancel');
                }
            }
        }
    
        return redirect()->route('donation.payment.cancel')->with('error', 'Invalid payment method.');
    }


    public function paymentPaypal(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);
        if(isset($response['status']) && $response['status'] == 'COMPLETED') {

            $getUser = User::where('email', session()->get('email'))->first();

            $userData = [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'password' => Hash::make('12345'),
                'address' => session()->get('address'),
                'phone' => session()->get('phone')
            ];

            $user = $getUser ?? null;

            if(!$getUser) {
                $user = User::create($userData);
            }

            // Insert data into database
            $obj = new CauseDonation;
            if(session()->has('cause_id')) {
                $obj->cause_id = session()->get('cause_id');
            }
            $obj->user_id = $user->id;
            $obj->price = session()->get('price');
            $obj->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $obj->donation_type = session()->get('donation_type');
            $obj->payment_id = $response['id'];
            $obj->payment_method = "PayPal";
            $obj->payment_status = $response['status'];
            $obj->save();

            if(session()->has('cause_id')) {
                $cause_data = Cause::where('id',session()->get('cause_id'))->first();
                $cause_data->raised = $cause_data->raised + session()->get('price');
                $cause_data->update();
            }

            // if(session()->has('cause_id')) {
                unset($_SESSION['cause_id']);
            // }
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['address']);
            unset($_SESSION['phone']);
            unset($_SESSION['price']);

            if(isset($cause_data)) {
                return redirect()->route('cause.show', $cause_data->slug)->with('success','Payment completed successfully');
            } 
            return redirect()->route('donate.index')->with('success','Payment completed successfully');

        } else {
            return redirect()->route('donation.payment.cancel');
        }
    }


    public function paymentStripe(Request $request)
    {
        if(isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            //dd($response);

            $getUser = User::where('email', session()->get('email'))->first();

            $userData = [
                'name' => session()->get('name'),
                'email' => session()->get('email'),
                'password' => Hash::make('12345'),
                'address' => session()->get('address'),
                'phone' => session()->get('phone')
            ];

            $user = $getUser ?? null;

            if(!$getUser) {
                $user = User::create($userData);
            }


            // Insert data into database
            $obj = new CauseDonation;
            if(isset($request->cause_id)) {
                $obj->cause_id = session()->get('cause_id');
            }
            $obj->user_id = $user->id;
            $obj->price = session()->get('price');
            $obj->currency = $response->currency;
            $obj->donation_type = session()->get('donation_type');
            $obj->payment_id = $response->id;
            $obj->payment_method = "Stripe";
            $obj->payment_status = "COMPLETED";
            $obj->save();

            if(isset($request->cause_id)) {
                $cause_data = Cause::where('id',session()->get('cause_id'))->first();
                $cause_data->raised = $cause_data->raised + session()->get('price');
                $cause_data->update();
            }

            // if(session()->has('cause_id')) {
                unset($_SESSION['cause_id']);
            // }
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['address']);
            unset($_SESSION['phone']);
            unset($_SESSION['price']);

            if(isset($request->cause_id)) {
                return redirect()->route('cause.show', $cause_data->slug)->with('success','Payment completed successfully');
            } 
            return redirect()->route('donate.index')->with('success','Payment completed successfully');
        } else {
            return redirect()->route('donation.payment.cancel');
        }
    }

    public function paymentCancel()
    {
        return redirect()->route('home')->with('error','Payment is cancelled');
    }
}
