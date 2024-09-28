<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Cause;
use App\Models\CauseDonation;
use App\Models\ProgramTicket;
use App\Services\CountryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function dashboard()
    {
        $total_ticket = 0;
        $total_ticket_price = 0;
        $event_ticket_data = ProgramTicket::where('user_id',auth()->user()->id)->get();
        foreach($event_ticket_data as $item) {
            $total_ticket += $item->number_of_tickets;
            $total_ticket_price += $item->total_price;
        }


        $total_donation_price = 0;
        $donation_data = CauseDonation::where('user_id',auth()->user()->id)->get();
        foreach($donation_data as $item) {
            $total_donation_price += $item->price;
        }


        return view('user.dashboard', compact('total_ticket', 'total_ticket_price', 'total_donation_price'));
    }

    public function editProfile()
    {
        $countries = $this->countryService->getCountries();
        $responseData = [
            'countries' => $countries
        ];
        return view('user.profile', $responseData);
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::guard('web')->user()->id,
            'phone' => 'nullable|string',
            'country_id' => 'nullable|string'
        ]);

        $user_data = User::find(Auth::guard('web')->user()->id);

        if($request->photo != null) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png',
            ]);

            if(Auth::guard('web')->user()->photo != null) {
                unlink(public_path('storage/uploads/photo/'.Auth::guard('web')->user()->photo));
            }

            $final_name = time().'.'.$request->photo->extension();
            $request->photo->storeAs('public/uploads/photo/', $final_name);
            $user_data->photo = $final_name;
        }

        if($request->password != '' || $request->password_confirmation != '') {
            $request->validate([
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ]);
            $user_data->password = Hash::make($request->password);
        }

        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->update();

        return redirect()->back()->with('success','Profile updated successfully');
    }

    public function programTicket()
    {
        $event_tickets = ProgramTicket::where('user_id', auth()->user()->id)->where('payment_status', 'COMPLETED')->get();
        return view('user.event.tickets', compact('event_tickets'));
    }

    public function programTicketInvoice($id)
    {
        $ticket_data = ProgramTicket::findOrFail($id);
        return view('user.event.invoice', compact('ticket_data'));
    }


    public function causeDonation()
    {
        $donations = CauseDonation::where('user_id', auth()->user()->id)->where('payment_status', 'COMPLETED')->get();
        return view('user.cause.donations', compact('donations'));
    }

    public function causeDonationInvoice($id)
    {
        $donation_data = CauseDonation::findOrFail($id);
        return view('user.cause.invoice', compact('donation_data'));
    }
}
