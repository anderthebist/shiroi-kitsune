<?php

namespace App\Listeners;

use App\Events\ForgetEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

use App\Mail\ForgotSender;

class SendEmailNotification
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
     * @param  ForgetEvent  $event
     * @return void
     */
    public function handle(ForgetEvent $event)
    {
        Mail:: to($event->email)->send(new ForgotSender($event->token));
    }
}
