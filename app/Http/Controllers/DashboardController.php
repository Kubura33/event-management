<?php

namespace App\Http\Controllers;

use App\Services\EventActivityLogService;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        return Inertia::render('Dashboard', [
            'numberOfEvents' => $user->events()->count(),
            'numberOfTotalAttendees' => $user->events()->withCount('attendees')->get()->sum('attendees_count'),
            'upcomingEvents' => $user->events()->whereFuture('date')->get(10),
            'totalEvents' => $user->events()->count(),
            'activityLogs' => app(EventActivityLogService::class)->get(),
        ]);
    }
}
