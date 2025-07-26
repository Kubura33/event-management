<?php

namespace App\Services;

use App\Models\Attendee;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EventActivityLogService
{
    public function get(): Collection
    {
        $user = auth()->user();
        try{
            return Cache::remember(
                $this->cacheKey($user->id),
                now()->addHour(),
                fn () => $this->build()
            );
        }catch (\Exception $exception){
            Log::info("An error occurred while retrieving cache from redis: " . $exception->getMessage());
        }
        return collect();

    }

    public function set(): void {
        $user = auth()->user();

        Cache::put(
            $this->cacheKey($user->id),
            $this->build(),
            now()->addHour()
        );
    }

    public function refresh(): void {
        $this->set();
    }

    public function build(): Collection
    {
        $registrationActivity = $this->getRegistrations();
        return $registrationActivity->merge($this->getCancelled())->sortByDesc('timestamp');
    }

    protected function cacheKey(int $userId): string
    {
        return "event-activity-log:user:{$userId}";
    }

    public function getRegistrations(): Collection
    {
        $user = auth()->user();

        return Attendee::with(['event:id,user_id,title'])
            ->whereHas('event', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->map(function ($attendeeLog) {
                return [
                    'message' => "{$attendeeLog->name} registered for event {$attendeeLog->event->title}",
                    'timestamp' => $attendeeLog->created_at->toDateTimeString(),
                ];
            });

    }

    public function getCancelled(): Collection
    {
        $user = auth()->user();

        return Attendee::with(['event:id,user_id,title'])
            ->whereNotNull('cancelled_at')
            ->whereHas('event', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderByDesc('cancelled_at')
            ->get(10)
            ->map(function ($attendeeLog) {
                return [
                    'message' => "{$attendeeLog->name} cancelled his registration for event {$attendeeLog->event->title}",
                    'timestamp' => $attendeeLog->cancelled_at->toDateTimeString(),
                ];
            });

    }
}
