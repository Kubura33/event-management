<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Events/Index', [
            'events' => Event::paginate(15)
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Events/Create');
    }

    public function store(EventRequest $request): Response
    {
        $event = Event::create($request->safe()->except(['image']));

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events', 'public');
            $event->image = $path;
            $event->save();
        }
        return Inertia::render('Events/Index', []);
    }
}
