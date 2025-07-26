<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $step = $this->get('step');

        return match ($step) {
            'overview' => $this->getOverviewRules(),
            'schedules' => $this->getScheduleRules(),
            'speakers' => $this->getSpeakerRules(),
            'faqs' => $this->getFAQRules(),
        };

    }

    protected function getOverviewRules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'description' => ['required', 'min:3', 'max:255'],
            'price' => ['required', 'numeric'],
            'country' => ['required', 'string', 'min:3', 'max:255'],
            'city' => ['required', 'string', 'min:3', 'max:255'],
            'address' => ['required', 'string', 'min:3', 'max:255'],
            'zipcode' => ['required', 'string', 'min:3', 'max:255'],
            'tags' => ['nullable', 'array'],
            'image' => ['nullable', 'image', 'max:4096'],

        ];
    }

    protected function getScheduleRules(): array
    {
        $schedules = $this->input('schedules');

        if (empty($schedules)) {
            return [];
        }

        return [
            'schedules' => ['array', 'min:1'],
            'schedules.*.title' => ['required', 'string', 'max:255'],
            'schedules.*.description' => ['nullable', 'string', 'max:1000'],
            'schedules.*.date' => ['required', 'date'],
            'schedules.*.time' => ['required', 'string'], // can be changed to date_format if needed
        ];
    }

    protected function getSpeakerRules(): array
    {
        $speakers = $this->input('speakers');

        if (empty($speakers)) {
            return [];
        }

        return [
            'speakers' => ['array', 'min:1'],
            'speakers.*.name' => ['required', 'string', 'max:255'],
            'speakers.*.title' => ['required', 'string', 'max:255'],
            'speakers.*.bio' => ['required', 'string'],
            'speakers.*.linkedin' => ['nullable', 'url'],
            'speakers.*.twitter' => ['nullable', 'url'],
            'speakers.*.website' => ['nullable', 'url'],
            'speakers.*.photo' => ['nullable', 'image', 'max:4096'],
        ];
    }

    protected function getFAQRules(): array
    {
        $faqs = $this->input('faqs');

        if (empty($faqs)) {
            return [];
        }

        return [
            'faqs' => ['array', 'min:1'],
            'faqs.*.question' => ['required', 'string', 'max:255'],
            'faqs.*.answer' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category does not exist',
        ];
    }
}
