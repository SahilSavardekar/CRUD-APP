<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Mail\UserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class MailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMail $event): void
    {
        //

        $toMessage = 'sahil@gmail.com';

        $messages = 'User Registered Successfully!';

        $response = Mail::to($toMessage)->send(new UserMail($messages));
    }
}
