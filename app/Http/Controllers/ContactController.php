<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

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

        Contact::create([
            'name' => request('name'),
            'email' => request('email'),
            'message' => request('message')
        ]);

        //to notify admin

        return back()->with('success', "Message is successfullly sent.");
    }
}
