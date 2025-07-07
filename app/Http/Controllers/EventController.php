<?php
declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EventController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Events/Index', [
            'events' => Event::limit(15)->get()
        ]);
    }
}
