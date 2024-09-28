<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
        // $programId = $this->route('program')->id;
        return [
            'name' => 'required|string|max:255',
            // 'slug' => 'required|string|max:255|unique:programs,slug,' . $programId,
            'type' => 'required|string|in:trade show,conference,workshop,seminar',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'start_date_time' => 'required|date_format:Y-m-d\TH:i|before:end_date_time',
            'end_date_time' => 'required|date_format:Y-m-d\TH:i|after:start_date_time',
            'location' => 'required|string|max:255',
            'map' => 'nullable|string',
            'price' => 'nullable|integer|min:0',
            'total_seat' => 'nullable|integer|min:1',
            // 'booked_seat' => 'nullable|integer|min:0|lte:total_seat'
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The program name is required.',
            'name.max' => 'The program name cannot exceed 255 characters.',
            // 'slug.required' => 'The program slug is required.',
            // 'slug.max' => 'The program slug cannot exceed 255 characters.',
            // 'slug.unique' => 'The program slug must be unique.',
            'type.required' => 'Program type is required',
            'type.string' => 'Program type must be a string',
            'type.in' => 'Program type must be one of the following: trade show, conference, workshop or seminar',
            'short_description.required' => 'The short description is required.',
            'short_description.max' => 'The short description cannot exceed 500 characters.',
            'description.required' => 'The program description is required.',
            'photo.image' => 'The photo must be an image',
            'photo.mime' => 'The photo must be one of the following type: jpg, jpeg, png, gif, svg or webp',
            'photo.max' => 'The image size must be less than or equal to 5 MB.',
            'start_date_time.required' => 'The program start date and time is required.',
            'start_date_time.date_format' => 'The start date and time must be in the format YYYY-MM-DDTHH:MM.',
            'start_date_time.before' => 'The start date and time must be before the end date and time.',
            'end_date_time.required' => 'The program end date and time is required.',
            'end_date_time.date_format' => 'The end date and time must be in the format YYYY-MM-DDTHH:MM.',
            'end_date_time.after' => 'The end date and time must be after the start date and time.',
            'location.required' => 'The program location is required.',
            'price.integer' => 'The price must be a valid integer.',
            'price.min' => 'The price must be at least 0.',
            'total_seat.integer' => 'The total seat must be a valid integer.',
            'total_seat.min' => 'The total seat must be at least 1.',
            // 'booked_seat.integer' => 'The booked seat must be a valid integer.',
            // 'booked_seat.min' => 'The booked seat must be at least 0.',
            // 'booked_seat.lte' => 'The booked seat cannot exceed the total seats.'
        ];
    }
}
