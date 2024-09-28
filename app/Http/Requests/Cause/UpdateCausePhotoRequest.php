<?php

namespace App\Http\Requests\Cause;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCausePhotoRequest extends FormRequest
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
            'cause_id' => 'required|exists:cause_photos,cause_id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'cause_id.required' => 'Cause ID is required',
            'cause_id.exists' => 'Cause ID does not exist',

            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
