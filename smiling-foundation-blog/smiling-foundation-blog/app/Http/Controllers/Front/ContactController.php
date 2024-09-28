<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\StoreContactRequest;
use App\Mail\Websitemail;
use App\Services\AdminService;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return view('front.contact');
    }

    public function sendMessage(StoreContactRequest $request)
    {
        $request->validated();

        $adminData = $this->adminService->getAdmin();

        $subject = "Contact Form";
        $message = "Visitor Information: <br><br>";
        $message .= "Name: <br>".$request->name."<br><br>";
        $message .= "Email: <br>".$request->email."<br><br>";
        $message .= "Message: <br>".$request->message."<br><br>";

        Mail::to($adminData->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Message sent successfully');
    }
}
