<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Notifications\NotifyAdminContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function index()
    {
        return view('Public.contact-us');
    }

    public function store()
    {
        request()->validate([
            'name' => "required|min:1|max:100",
            "email" => "required|email",
            "message" => "required|min:3|max:1000"
        ]);

        $contact = Contact::create([
            'name' => request('name'),
            'email' => request('email'),
            'message' => request('message')
        ]);

        //to notify admin
        Notification::send(
            User::where('is_admin', "1")->get(),
            new NotifyAdminContactMessage($contact->name, $contact->email, $contact->message)
        );

        return back()->with('success', "Message is successfullly sent.");
    }
}
