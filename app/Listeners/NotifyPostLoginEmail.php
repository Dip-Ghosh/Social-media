<?php

namespace App\Listeners;

use App\Events\PostLoginEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailSending;

class NotifyPostLoginEmail
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
     * @param  PostLoginEmail  $event
     * @return void
     */
    public function handle(PostLoginEmail $event)
    {
        Mail::to($event->user->email)->send(new EmailSending($event->user->name));
    }
}
