<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\Websitemail;
use App\Models\Admin;
use App\Models\Photo;
use App\Models\Program;
use App\Models\ProgramPhoto;
use App\Models\ProgramTicket;
use App\Models\ProgramVideo;
use App\Models\User;
use App\Models\Video;
use App\Services\ProgramService;
use App\Services\ProgramTicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Stripe\StripeClient;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class ProgramController extends Controller
{
    protected ProgramService $programService;
    protected ProgramTicketService $programTicketService;

    public function __construct(ProgramService $programService, ProgramTicketService $programTicketService)
    {
        $this->programService = $programService;
        $this->programTicketService = $programTicketService;
    }

    public function index()
    {
        $programs = $this->programService->getActivePrograms();

        $validatedData = [
            'programs' => $programs
        ];

        return view('front.program.index', $validatedData);
    }

    public function show(Program $program)
    {
        $programPhotos = ProgramPhoto::where('program_id',$program->id)->get();
        $programVideos = ProgramVideo::where('program_id',$program->id)->get();
        // $program_faqs = programFaq::where('program_id',$program->id)->get();
        $recentPrograms = $this->programService->getRecentActivePrograms();
        $responseData = [
            'program' => $program,
            'programPhotos' => $programPhotos,
            'programVideos' => $programVideos,
            'recentPrograms' => $recentPrograms
        ];
        return view('front.program.show', $responseData);
    }

    // public function sendMessage(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'message' => 'required'
    //     ]);

    //     $admin_data = Admin::first();
    //     $admin_email = $admin_data->email;

    //     $program_data = Program::where('id',$request->program_id)->first();

    //     $subject = "Message from visitor for Program - ".$program_data->name;
    //     $message = "<b>Visitor Information:</b><br><br>";
    //     $message .= "Name: ".$request->name."<br>";
    //     $message .= "Email: ".$request->email."<br>";
    //     $message .= "Phone: ".$request->phone."<br>";
    //     $message .= "Message: ".$request->message."<br><br>";
    //     $message .= "<b>Program Page URL: </b><br>";
    //     $message .= "<a href='".url('/program/'.$program_data->slug)."'>".url('/program/'.$program_data->slug)."</a>";

    //     Mail::to($admin_email)->send(new Websitemail($subject,$message));

    //     return redirect()->back()->with('success','Message sent successfully');
    // }

    public function payment(Request $request)
    {
        // if(!auth()->user()) {
        //     return redirect()->route('login');
        // }

        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'number_of_tickets' => 'required',
            'payment_method' => 'required'
        ]);

        $program_data = Program::where('id',$request->program_id)->first();

        if($program_data->total_seat > 0) {
            $remaining_seat = $program_data->total_seat - $program_data->booked_seat;
            if($program_data->booked_seat + $request->number_of_tickets > $program_data->total_seat) {
                return redirect()->back()->with('error','Sorry, only '.$remaining_seat.' tickets/seats are available');
            }
        }

        $total_price = $request->number_of_tickets * $request->unit_price;

        if($request->payment_method == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('programs.ticket.payment.paypal'),
                    "cancel_url" => route('programs.ticket.payment.cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $total_price
                        ]
                    ]
                ]
            ]);
            //dd($response);
            if(isset($response['id']) && $response['id']!=null) {
                foreach($response['links'] as $link) {
                    if($link['rel'] === 'approve') {
                        session()->put('program_id', $request->program_id);
                        session()->put('name', $request->name);
                        session()->put('email', $request->email);
                        session()->put('address', $request->address);
                        session()->put('phone', $request->phone);
                        session()->put('unit_price', $request->unit_price);
                        session()->put('number_of_tickets', $request->number_of_tickets);
                        session()->put('total_price', $total_price);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('programs.ticket.payment.cancel');
            }
        }

        if($request->payment_method == 'stripe') {
            $stripe = new StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $program_data->name,
                            ],
                            'unit_amount' => $total_price*100,
                        ],
                        'quantity' => $request->number_of_tickets,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('programs.ticket.payment.stripe').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('programs.ticket.payment.cancel'),
            ]);
            //dd($response);
            if(isset($response->id) && $response->id != ''){
                session()->put('program_id', $request->program_id);
                session()->put('name', $request->name);
                session()->put('email', $request->email);
                session()->put('address', $request->address);
                session()->put('phone', $request->phone);
                session()->put('unit_price', $request->unit_price);
                session()->put('number_of_tickets', $request->number_of_tickets);
                session()->put('total_price', $total_price);
                return redirect($response->url);
            } else {
                return redirect()->route('programs.ticket.payment.cancel');
            }
        }
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
            $obj = new ProgramTicket;
            $obj->program_id = session()->get('program_id');
            $obj->user_id = $user->id;
            // $obj->name = session()->get('name');
            // $obj->email = session()->get('email');
            // $obj->address = session()->get('address');
            // $obj->phone = session()->get('phone');
            $obj->unit_price = session()->get('unit_price');
            $obj->number_of_tickets = session()->get('number_of_tickets');
            $obj->total_price = session()->get('total_price');
            $obj->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $obj->payment_id = $response['id'];
            $obj->payment_method = "PayPal";
            $obj->payment_status = $response['status'];
            $obj->save();

            $program_data = Program::where('id',session()->get('program_id'))->first();
            $program_data->booked_seat = $program_data->booked_seat + session()->get('number_of_tickets');
            $program_data->update();

            unset($_SESSION['program_id']);
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['address']);
            unset($_SESSION['phone']);
            unset($_SESSION['unit_price']);
            unset($_SESSION['number_of_tickets']);
            unset($_SESSION['total_price']);

            return redirect()->route('programs.show',$program_data->slug)->with('success','Payment completed successfully');

        } else {
            return redirect()->route('programs.ticket.payment.cancel');
        }
    }


    public function paymentStripe(Request $request)
    {
        if(isset($request->session_id)) {

            $stripe = new StripeClient(config('stripe.stripe_sk'));
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
            $obj = new ProgramTicket;
            $obj->program_id = session()->get('program_id');
            $obj->user_id = $user->id;
            $obj->unit_price = session()->get('unit_price');
            $obj->number_of_tickets = session()->get('number_of_tickets');
            $obj->total_price = session()->get('total_price');
            $obj->currency = $response->currency;
            $obj->payment_id = $response->id;
            $obj->payment_method = "Stripe";
            $obj->payment_status = "COMPLETED";
            $obj->save();

            $program_data = Program::where('id',session()->get('program_id'))->first();
            $program_data->booked_seat = $program_data->booked_seat + session()->get('number_of_tickets');
            $program_data->update();

            unset($_SESSION['program_id']);
            unset($_SESSION['name']);
            unset($_SESSION['email']);
            unset($_SESSION['address']);
            unset($_SESSION['phone']);
            unset($_SESSION['unit_price']);
            unset($_SESSION['number_of_tickets']);
            unset($_SESSION['total_price']);

            return redirect()->route('programs.show', $program_data->slug)->with('success','Payment completed successfully');

        } else {
            return redirect()->route('programs.ticket.payment.cancel');
        }
    }


    public function freeBooking(Request $request)
    {
        // if(!auth()->user()) {
        //     return redirect()->route('login');
        // }

        $request->validate([
            'number_of_tickets' => 'required'
        ]);

        $program_data = Program::where('id',$request->program_id)->first();

        if($program_data->total_seat > 0) {
            $remaining_seat = $program_data->total_seat - $program_data->booked_seat;
            if($program_data->booked_seat + $request->number_of_tickets > $program_data->total_seat) {
                return redirect()->back()->with('error','Sorry, only '.$remaining_seat.' tickets/seats are available');
            }
        }

        $total_price = $request->number_of_tickets * $request->unit_price;

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
        $obj = new ProgramTicket;
        $obj->program_id = $request->program_id;
        $obj->user_id = $user->id;
        $obj->unit_price = $request->unit_price;
        $obj->number_of_tickets = $request->number_of_tickets;
        $obj->total_price = $total_price;
        $obj->currency = "";
        $obj->payment_id = "payment_no_".time();
        $obj->payment_method = "Free";
        $obj->payment_status = "COMPLETED";
        $obj->save();

        $program_data = Program::where('id',$request->program_id)->first();
        $program_data->booked_seat = $program_data->booked_seat + $request->number_of_tickets;
        $program_data->update();

        return redirect()->route('programs.show',$program_data->slug)->with('success','Booking completed successfully');

    }


    public function paymentCancel()
    {
        return redirect()->route('home')->with('error','Payment is cancelled');
    }

    // public function tickets(Program $program, User $user)
    // {
    //     $programTickets = $this->programTicketService->getProgramTicketByUser($program, $user);
    //     $responseData = [
    //         'programTickets' => $programTickets
    //     ];
    //     return view('front.program.tickets', $responseData);
    // }

    // public function ticketInvoice(Program $program)
    // {
    //     $programTicket = $program->load('programTicket')->programTicket;
    //     $user = $programTicket->load('user')->user;
    //     $responseData = [
    //         'programTicket' => $programTicket,
    //         'user' => $user
    //     ];
    //     return view('front.program.invoice', $responseData);
    // }
}
