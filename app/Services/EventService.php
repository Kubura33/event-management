<?php

namespace App\Services;

use App\DTOs\EventData;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class EventService
{
    protected ?Event $event = null;

    public string $nextStep = 'overview';

    public function __construct(
        protected User $user,
        public ?EventData $eventDto = null,
    ) {
        if ($this->eventDto && $this->eventDto->id) {
            $this->event = Event::with(['speakers', 'faqs', 'schedules'])->findOrFail($this->eventDto->id);
        }
    }

    public function saveStep(string $step): self
    {
        match ($step) {
            'overview' => $this->saveOverview(),
            'schedules' => $this->createSchedules(),
            'speakers' => $this->createSpeakers(),
            'faqs' => $this->createFaqs(),
        };

        return $this;
    }

    public function saveOverview(): self
    {
        if (! $this->event) {
            $this->event = Event::create([
                'user_id' => $this->user->id,
                'title' => $this->eventDto->title,
                'category_id' => $this->eventDto->category_id,
                'start_date' => $this->eventDto->start_date,
                'end_date' => $this->eventDto->end_date,
                'description' => $this->eventDto->description,
                'price' => $this->eventDto->price,
                'capacity' => $this->eventDto->capacity,
                'country' => $this->eventDto->country,
                'city' => $this->eventDto->city,
                'address' => $this->eventDto->address,
                'zipcode' => $this->eventDto->zipcode,
                'tags' => $this->eventDto->tags ?? [],
                'status' => 'draft',
            ]);
        } else {
            $this->event->update([
                'title' => $this->eventDto->title,
                'category_id' => $this->eventDto->category_id,
                'start_date' => $this->eventDto->start_date,
                'end_date' => $this->eventDto->end_date,
                'description' => $this->eventDto->description,
                'price' => $this->eventDto->price,
                'capacity' => $this->eventDto->capacity,
                'country' => $this->eventDto->country,
                'city' => $this->eventDto->city,
                'address' => $this->eventDto->address,
                'zipcode' => $this->eventDto->zipcode,
                'tags' => $this->eventDto->tags ?? [],
            ]);
        }

        if ($this->eventDto->image) {
            $path = Storage::disk('public')->put('events', $this->eventDto->image);
            $this->event->update(['image' => $path]);
        }

        $this->nextStep = 'schedules';

        return $this;
    }

    public function finalize(bool $final): Event
    {
        if ($final) {
            $this->event->update(['status' => 'published']);
        }

        return $this->event;
    }

    protected function createSchedules(): void
    {
        $schedules = $this->eventDto->schedules ?? [];

        foreach ($schedules as $schedule) {
            $this->event->schedules()->updateOrCreate(
                [
                    'event_id' => $this->event->id,
                    'title' => $schedule['title'] ?? '',
                    'date' => $schedule['date'] ?? null,
                ],
                [
                    'start_time' => $schedule['start_time'] ?? null,
                    'end_time' => $schedule['end_time'] ?? null,
                    'description' => $schedule['description'] ?? '',
                ]
            );
        }

        $this->nextStep = 'speakers';
    }

    protected function createSpeakers(): void
    {
        $speakers = $this->eventDto->speakers ?? [];

        foreach ($speakers as $speaker) {
            $speakerModel = $this->event->speakers()->updateOrCreate(
                [
                    'event_id' => $this->event->id,
                    'name' => $speaker['name'] ?? '',
                ],
                [
                    'role' => $speaker['role'] ?? '',
                    'bio' => $speaker['bio'] ?? '',
                    'linkedin' => $speaker['linkedin'] ?? '',
                    'twitter' => $speaker['twitter'] ?? '',
                    'website' => $speaker['website'] ?? '',
                ]
            );

            if (isset($speaker['photo']) && $speaker['photo']) {
                $path = Storage::disk('public')->put('speakers', $speaker['photo']);
                $speakerModel->update(['photo' => $path]);
            }
        }

        $this->nextStep = 'faqs';
    }

    protected function createFaqs(): void
    {
        $faqs = $this->eventDto->faqs ?? [];

        foreach ($faqs as $faq) {
            $this->event->faqs()->updateOrCreate(
                [
                    'event_id' => $this->event->id,
                    'question' => $faq['question'] ?? '',
                ],
                [
                    'answer' => $faq['answer'] ?? '',
                ]
            );
        }

        $this->nextStep = 'complete';
    }
}
