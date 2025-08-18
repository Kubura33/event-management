<?php

namespace App\DTOs;

use App\Models\Event;
use Symfony\Component\HttpFoundation\File\UploadedFile;

readonly class EventData
{
    public function __construct(
        public ?int          $id = null,
        public ?string       $title = null,
        public ?int          $category_id = null,
        public ?string       $start_date = null,
        public ?string       $end_date = null,
        public ?string       $description = null,
        public ?float        $price = null,
        public ?int          $capacity = null,
        public ?string       $country = null,
        public ?string       $city = null,
        public ?string       $address = null,
        public ?string       $zipcode = null,
        public array         $tags = [],
        public ?UploadedFile $image = null,
        public ?string       $image_url = null,
        public array         $schedules = [],
        public array         $speakers = [],
        public array         $faqs = [],
        public ?string       $step = null,
        public ?string       $status = null,
    ) {}

    public static function overview(array $data): self
    {
        \Log::info("I got data and the event ID on the first step is: " . ($data['event_id'] ?? 'null'));
        return new self(
            id: $data['event_id'] ?? null,
            title: $data['title'] ?? null,
            category_id: $data['category_id'] ?? null,
            start_date: $data['start_date'] ?? null,
            end_date: $data['end_date'] ?? null,
            description: $data['description'] ?? null,
            price: $data['price'] ?? null,
            capacity: $data['capacity'] ?? null,
            country: $data['country'] ?? null,
            city: $data['city'] ?? null,
            address: $data['address'] ?? null,
            zipcode: $data['zipcode'] ?? null,
            tags: $data['tags'] ?? [],
            image: $data['image'] ?? null,
            step: 'overview',
            status: 'draft',
        );
    }

    public static function schedules(array $data): self
    {
        return new self(
            id: $data['event_id'] ?? null,
            schedules: $data['schedules'] ?? [],
            step: 'schedules',
        );
    }

    public static function speakers(array $data): self
    {
        return new self(
            id: $data['event_id'] ?? null,
            speakers: $data['speakers'] ?? [],
            step: 'speakers',
        );
    }

    public static function faqs(array $data): self
    {
        return new self(
            id: $data['event_id'] ?? null,
            faqs: $data['faqs'] ?? [],
            step: 'faqs',
        );
    }

    public static function fromModel(Event $event, string $currentStep = 'overview'): self
    {
        return new self(
            id: $event->id,
            title: $event->title,
            category_id: $event->category_id,
            start_date: $event->start_date,
            end_date: $event->end_date,
            description: $event->description,
            price: $event->price,
            capacity: $event->capacity,
            country: $event->country,
            city: $event->city,
            address: $event->address,
            zipcode: $event->zipcode,
            tags: $event->tags ?? [],
            image_url: $event->image,
            schedules: $event->schedules?->toArray() ?? [],
            speakers: $event->speakers?->toArray() ?? [],
            faqs: $event->faqs?->toArray() ?? [],
            step: $currentStep,
            status: $event->status,
        );
    }
}
