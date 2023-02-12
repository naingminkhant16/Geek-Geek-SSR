<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use App\Models\Email;
use App\Models\EmailReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminEmailReplyController extends Controller
{
    public function create(Email $email)
    {
        return view("Admin.Email.Reply.create", ['email' => $email]);
    }

    public function store()
    {
        request()->validate([
            'email_id' => "required|exists:emails,id",
            'body' => "required|min:3|max:1000",
            'files' => "nullable",
            "files.*" => "mimes:png,jpg,pdf,jpeg|max:512"
        ]);

        $email =  Email::findOrFail(request('email_id'));

        if (request()->file('files')) {
            $toStoreFiles = [];
            foreach (request()->file('files') as $file) {
                $generate_name = rand(1, 100) . "_" . str_replace(" ", "_", $file->getClientOriginalName());
                $file->storeAs('public/mail_files', $generate_name);
                $toStoreFiles[] = $generate_name;
            }
        }

        $reply =  EmailReply::create([
            "email_id" => $email->id,
            "body" => request('body'),
            "attach_files" => $toStoreFiles ?? null
        ]);

        Mail::to($email->recipient)->queue(new CustomMail(
            $email->subject,
            $reply->body,
            $reply->attach_files
        ));

        return redirect()->route('admin.emails.show', $email->id)->with("success", "Reply Mail is successfully sent.");
    }
}
