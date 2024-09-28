<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoRequest extends FormRequest
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
            'photo_category_id' => 'required|exists:photo_categories,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'photo_category_id.required' => 'Photo Category is required',
            'photo_category_id.exists' => 'Photo Category does not exist',

            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
