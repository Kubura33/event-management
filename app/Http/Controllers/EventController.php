<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
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

    public function create(): Response
    {

        return Inertia::render('Events/Create',
            [
                'categories' => Category::all(),
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
        $event = auth()->user()->events()->create($request->safe()->except(['image']));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $event->image = $path;
            $event->save();
        }

        return redirect()->route('events.index');

    }

    public function update(EventRequest $request, Event $event): RedirectResponse
    {
        if($request->user()->cannot('update', $event)) {
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
        if(auth()->user()->cannot('delete', $event)) {
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
