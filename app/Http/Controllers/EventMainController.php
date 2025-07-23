<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventMainController extends Controller
{
    public function events(): Response
    {
        return Inertia::render('MainPage',
            [
                'events' => Event::latest()->paginate(15),
            ]
        );
    }

    public function event(Event $event): Response
    {
        return Inertia::render('MainEventShow', ['event' => $event]);
    }

    public function browseEvents(Request $request): Response
    {
        return Inertia::render('BrowseEvents',
            [
                'events' => Event::filter($request->all())->paginate(15)->withQueryString(),
                'filters' => $request->all(),
                'categories' => Category::all(),
                'locations' => Event::select('city', 'country')
                    ->distinct()
                    ->orderBy('city')
                    ->get()
                    ->map(fn ($e) => "{$e->city}, {$e->country}"),
            ]
        );
    }
}
