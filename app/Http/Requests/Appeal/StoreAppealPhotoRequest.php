<?php

namespace App\Http\Requests\Appeal;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppealPhotoRequest extends FormRequest
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
            'appeal_id' => 'required|exists:appeal_photos,appeal_id',
            'photo' => 'required',
            'photo.*' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'appeal_id.required' => 'Appeal ID is required',
            'appeal_id.exists' => 'Appeal ID does not exist',

            'photo.required' => 'The photo field is required.',
            'photo.*.image' => 'The photo must be an image.',
            'photo.*.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.*.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
