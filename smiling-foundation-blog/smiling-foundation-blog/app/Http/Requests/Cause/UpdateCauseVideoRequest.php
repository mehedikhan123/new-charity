<?php

namespace App\Http\Requests\Cause;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCauseVideoRequest extends FormRequest
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
            'video' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'cause_id.required' => 'Cause ID is required',
            'cause_id.exists' => 'Cause ID does not exist',

            'video.string' => 'Each YouTube Video ID must be a string'
        ];
    }
}
