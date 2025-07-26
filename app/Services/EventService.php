<?php

namespace App\Services;

use App\Models\Event;
use App\Models\PendingEvent;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EventService {

    public function __construct(
        protected User $user,
        public array $overview = [],
        public array $speakers = [],
        public array $faqs = [],
        public array $schedules = [],
        public ?PendingEvent $pendingEvent = null
    ) {
        $this->pendingEvent ??= PendingEvent::firstOrCreate(['user_id' => $user->id]);
    }



    public function createSpeakers(Event $event): void
    {
        if (empty($this->speakers)) {
            return;
        }

        foreach ($this->speakers as $speaker) {
            $event->speakers()->create([
                'name' => $speaker['name'] ?? '',
                'role' => $speaker['role'] ?? '',
                'bio' => $speaker['bio'] ?? '',
                'linkedin' => $speaker['linkedin'] ?? '',
                'twitter' => $speaker['twitter'] ?? '',
                'website' => $speaker['website'] ?? '',
                'photo' => $speaker['photo'] ?? null,
            ]);
        }
    }

    public function createSchedules(Event $event): void
    {
        if (empty($this->schedules)) {
            return;
        }

        foreach ($this->schedules as $schedule) {
            $event->schedules()->create([
                'start_time' => $schedule['start_time'] ?? null,
                'end_time' => $schedule['end_time'] ?? null,
                'title' => $schedule['title'] ?? '',
                'description' => $schedule['description'] ?? '',
                'date' => $schedule['date'] ?? null,
            ]);
        }
    }


    public function createFaqs(Event $event): void
    {
        if (empty($this->faqs)) {
            return;
        }

        foreach ($this->faqs as $faq) {
            $event->faqs()->create([
                'question' => $faq['question'] ?? '',
                'answer' => $faq['answer'] ?? '',
            ]);
        }
    }

    public function step(string $step, array $data): self{
            match ($step) {
                'overview' => $this->overview = $data,
                'speakers' => $this->speakers = $data,
                'faqs' => $this->faqs = $data,
                'schedules' => $this->schedules = $data,
            };
            return $this;
    }

    public function savePendingEvent(): self
    {
        $this->pendingEvent->update([
            'title' => $this->overview['title'] ?? null,
            'category_id' => $this->overview['category_id'] ?? null,
            'start_date' => $this->overview['start_date'] ?? null,
            'end_date' => $this->overview['end_date'] ?? null,
            'description' => $this->overview['description'] ?? null,
            'price' => $this->overview['price'] ?? null,
            'country' => $this->overview['country'] ?? null,
            'city' => $this->overview['city'] ?? null,
            'zipcode' => $this->overview['zipcode'] ?? null,
            'address' => $this->overview['address'] ?? null,
            'tags' => $this->overview['tags'] ?? [],
            'image_path' => $this->overview['image_path'] ?? null,

            // Optional: Save the full structures as JSON if stored in JSON columns
            'schedules' => $this->schedules,
            'speakers' => $this->speakers,
            'faqs' => $this->faqs,
        ]);

        return $this;
    }

    protected function createEvent(): Event
    {
        return Event::create([
            'user_id' => $this->user->id,
            'title' => $this->overview['title'],
            'category_id' => $this->overview['category_id'],
            'start_date' => $this->overview['start_date'],
            'end_date' => $this->overview['end_date'],
            'description' => $this->overview['description'],
            'price' => $this->overview['price'],
            'country' => $this->overview['country'],
            'city' => $this->overview['city'],
            'zipcode' => $this->overview['zipcode'] ?? null,
            'address' => $this->overview['address'] ?? null,
            'tags' => $this->overview['tags'] ?? [],
            'image_path' => $this->overview['image_path'] ?? null,
        ]);
    }

    public function finalize(bool $final): ?Event
    {
        if (!$final) {
            $this->savePendingEvent();
            return null;
        }

        return DB::transaction(function () {
            $event = $this->createEvent();
            $this->createSchedules($event);
            $this->createSpeakers($event);
            $this->createFaqs($event);

            $this->pendingEvent->delete();

            return $event;
        });
    }



}
