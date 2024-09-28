<?php

namespace App\Http\Requests\Cause;

use Illuminate\Foundation\Http\FormRequest;

class StoreCauseVideoRequest extends FormRequest
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
            'cause_id' => 'required|exists:cause_videos,cause_id',
            'video' => 'required|array',
            'video.*' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'cause_id.required' => 'Cause ID is required',
            'cause_id.exists' => 'Cause ID does not exist',

            'video.required' => 'YouTube Video ID is required',
            'video.array' => 'YouTube Video ID must be an array',
            'video.*.required' => 'Each YouTube Video ID is required',
            'video.*.string' => 'Each YouTube Video ID must be a string',
        ];
    }
}
