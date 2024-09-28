<?php

namespace App\Http\Requests\Program;

use Illuminate\Foundation\Http\FormRequest;

class StoreProgramPhotoRequest extends FormRequest
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
            'program_id' => 'required|exists:program_photos,program_id',
            'photo' => 'required',
            'photo.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'program_id.required' => 'Program ID is required',
            'program_id.exists' => 'Program ID does not exist',

            'photo.required' => 'The photo field is required.',
            'photo.*.image' => 'The photo must be an image.',
            'photo.*.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.*.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
