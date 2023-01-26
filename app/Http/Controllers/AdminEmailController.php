<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminEmailController extends Controller
{
    public function index()
    {
        $mails = Email::with(['user:profile'])->latest()->paginate(6)->withQueryString();

        return view('Admin.Email.index', ['mails' => $mails]);
    }

    public function create()
    {
        return view('Admin.Email.create');
    }

    public function store()
    {
        request()->validate([
            'recipient' => "required|email",
            'subject' => "required|max:50",
            'body' => "required|min:3|max:1000",
            'files' => "nullable",
            "files.*" => "mimes:png,jpg,pdf,jpeg|max:512"
        ]);

        if (request()->file('files')) {
            $toStoreFiles = [];
            foreach (request()->file('files') as $file) {
                $generate_name = rand(1, 100) . "_" . str_replace(" ", "_", $file->getClientOriginalName());
                $file->storeAs('public/mail_files', $generate_name);
                $toStoreFiles[] = $generate_name;
            }
        }

        $email = Email::create([
            "subject" => request('subject'),
            "body" => request('body'),
            "sender" => getenv('MAIL_FROM_ADDRESS'),
            "recipient" => request("recipient"),
            "attach_files" => $toStoreFiles ?? null
        ]);

        //send mail
        Mail::to($email->recipient)->send(new CustomMail(
            $email->subject,
            $email->body,
            $email->attach_files
        ));

        return redirect()->route('admin.emails.index')->with('success', "Email Successfully Sent.");
    }
}
