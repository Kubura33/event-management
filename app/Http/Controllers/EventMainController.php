<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventMainController extends Controller
{
    public function events(): Response
    {
        return Inertia::render('MainPage', ['events' => Event::limit(15)->get()]);
    }

    public function event(Event $event): Response
    {
        return Inertia::render('MainEventShow', ['event' => $event]);
    }
}
