<?php

namespace App\Http\Requests\Appeal;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppealVideoRequest extends FormRequest
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
            'appeal_id' => 'required|exists:appeal_videos,appeal_id',
            'video' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'appeal_id.required' => 'Appeal ID is required',
            'appeal_id.exists' => 'Appeal ID does not exist',

            'video.string' => 'Each YouTube Video ID must be a string'
        ];
    }
}
