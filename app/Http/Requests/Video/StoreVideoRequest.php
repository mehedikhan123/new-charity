<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
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
            'video_category_id' => 'required|exists:video_categories,id',
            'video' => 'required|array',
            'video.*' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'video_category_id.required' => 'Video Category is required',
            'video_category_id.exists' => 'Video Category does not exist',
            
            'video.required' => 'YouTube Video ID is required',
            'video.array' => 'YouTube Video ID must be an array',
            'video.*.required' => 'Each YouTube Video ID is required',
            'video.*.string' => 'Each YouTube Video ID must be a string',
        ];
    }
}
