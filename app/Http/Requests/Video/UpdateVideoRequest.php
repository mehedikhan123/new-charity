<?php

namespace App\Http\Requests\Video;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVideoRequest extends FormRequest
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
            'video' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'video_category_id.required' => 'Video Category is required',
            'video_category_id.exists' => 'Video Category does not exist',
            
            'video.string' => 'YouTube Video ID must be a string'
        ];
    }
}
