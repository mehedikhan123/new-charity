<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramVideoRequest extends FormRequest
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
            'video' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'program_id.required' => 'Program ID is required',
            'program_id.exists' => 'Program ID does not exist',

            'video.string' => 'Each YouTube Video ID must be a string'
        ];
    }
}
