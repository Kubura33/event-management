<?php

namespace App\Listeners;

use App\Events\EventRegistrationCreated;
use App\Mail\RegistrationConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmail implements ShouldQueue
{
    use InteractsWithQueue;
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
    public function handle(EventRegistrationCreated $event): void
    {
        Mail::to($event->attendee->email)
            ->send(new RegistrationConfirmed($event->attendee, $event->cancelUrl));
    }
}
