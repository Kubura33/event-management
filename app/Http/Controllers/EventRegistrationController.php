<?php

namespace App\Http\Controllers;

use App\Events\EventRegistrationCreated;
use App\Models\Attendee;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class EventRegistrationController extends Controller
{
    public function register(Event $event ,Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
        ]);
        $registration = $event->attendees()->create([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $expiresAt = Carbon::parse($event->date)->subDays(5);;
        if($expiresAt->isPast()) {
            $expiresAt = now()->addDay();
        }
        $url = URL::temporarySignedRoute(
            'registrations.cancel',
            $expiresAt,
            ['attendee' => $registration->id]
        );
        event(new EventRegistrationCreated($registration, $url));

    }

    public function cancel(Attendee $attendee)
    {
        $event = $attendee->event;
        // Block if inside 5-day window (double-check server-side)
        abort_if(now()->greaterThan(Carbon::parse($event->date)->subDays(5)), 410, 'Link expired.');

        // Already canceled?
        abort_if($attendee->canceled_at, 410, 'Already canceled.');

        $attendee->update(['canceled_at' => now()]);

        return redirect()->route('events.show', $event->slug)->with('success', 'Your spot was canceled.');
    }

}
