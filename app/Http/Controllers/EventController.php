<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTOs\EventData;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();

        return Inertia::render('Events/Index', [
            'events' => $user->events()->paginate(15),
        ]);
    }

    public function create(Request $request): Response
    {
        $eventData = null;

        if ($request->has('event_id')) {
            $eventId = $request->get('event_id');
            \Log::info("Event ID: " . $eventId);
            $eventData = EventData::fromModel(Event::with(['faqs', 'speakers', 'schedules'])->findOrFail($eventId), $request->get('step'));
        }

        return Inertia::render('Events/Create',
            [
                'categories' => Category::all(),
                'event' => $eventData,
                'event_id' => (int)$request->get('event_id', null),
                'step' => $request->get('step', 'overview'),
            ]);
    }

    public function edit(Event $event): Response
    {
        return Inertia::render('Events/Edit', [
            'event' => $event,
        ]);
    }

    public function show(Event $event): Response
    {
        return Inertia::render('Events/Show', [
            'event' => $event,
        ]);
    }

    public function store(EventRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $eventDto = $request->toDto();
        // Initialize the service
        $service = new EventService(
            user: $user,
            eventDto: $eventDto,
        );
        $step = $request->get('step');
        $final = $request->boolean('final', false); // assuming you're passing this flag

        // Save the step
        $event = $service->saveStep($step)
        ->finalize($final);
        \Log::info("Event ID after saving step: " . ($event->id ?? 'null'));

        // Either save to PendingEvent or finalize to full Event
        if ($final) {
            return redirect()->route('events.index');
        }

        return redirect()->route('events.create', ['step' => $service->nextStep, 'event_id' => $event->id]);

    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        if ($request->user()->cannot('update', $event)) {
            abort(403);
        }
        $event->update($request->safe()->except('image'));
        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $event->image = $request->file('image')->store('events', 'public');
            $event->save();
        }

        return redirect()->route('events.index');
    }

    public function destroy(Event $event): RedirectResponse
    {
        if (auth()->user()->cannot('delete', $event)) {
            abort(403);
        }
        $event->delete();

        session()->flash('notification', [
            'type' => 'success',
            'message' => 'Event deleted successfully!',
        ]);

        return redirect()->route('events.index');
    }
}
