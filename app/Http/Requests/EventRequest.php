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
        return [
            'title' => ['required', 'min:3', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['required', 'min:3', 'max:255'],
            'date' => ['required', 'date'],
            'price' => ['required', 'numeric'],
            'city' => ['required', 'min:3', 'max:255'],
            'address' => ['required', 'min:3', 'max:255'],
            'country' => ['required', 'min:3', 'max:255'],
            'zipcode' => ['required', 'numeric'],
            'capacity' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:4096'],
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
