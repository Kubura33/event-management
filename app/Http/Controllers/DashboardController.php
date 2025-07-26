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
            'numberOfTotalAttendees' => $user->events()
                ->withCount('activeAttendees')
                ->get()
                ->sum('active_attendees_count'),
            'upcomingEvents' => $user->events()
                ->whereFuture('date')
                ->withCount([
                    'activeAttendees as attendees',
                ])
                ->limit(10)
                ->get(),
            'totalEvents' => $user->events()->count(),
            'activityLogs' => app(EventActivityLogService::class)->get(),
            'topEventsByAttendance' => $user->events()
                ->withCount(['activeAttendees as attendees'])
                ->orderBy('attendees_count', 'desc')
                ->limit(5)
                ->whereFuture('date')
                ->get(),
        ]);
    }
}
