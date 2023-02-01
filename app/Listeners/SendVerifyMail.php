<?php

namespace App\Listeners;

use App\Events\EmailVerify;
use App\Mail\EmailVerify as MailEmailVerify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendVerifyMail implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\EmailVerify  $event
     * @return void
     */
    public function handle(EmailVerify $event)
    {
        $user = $event->user;
        Cache::put('email_verify_token_' . $user->id, $user->username . Str::random(100), now()->addMinutes(10));

        Mail::to($user->email)->queue(new MailEmailVerify($user, Cache::get('email_verify_token_' . $user->id)));
    }
}
