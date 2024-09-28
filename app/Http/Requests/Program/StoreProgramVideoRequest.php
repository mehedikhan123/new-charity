<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramVideoRequest extends FormRequest
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
            'program_id' => 'required|exists:program_videos,program_id',
            'video' => 'required|array',
            'video.*' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'program_id.required' => 'Program ID is required',
            'program_id.exists' => 'Program ID does not exist',

            'video.required' => 'YouTube Video ID is required',
            'video.array' => 'YouTube Video ID must be an array',
            'video.*.required' => 'Each YouTube Video ID is required',
            'video.*.string' => 'Each YouTube Video ID must be a string',
        ];
    }
}
