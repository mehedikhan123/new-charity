<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'heading' => 'required|string|max:255',
            'text' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'heading.required' => 'The heading is required.',
            'heading.string' => 'The heading must be a string.',
            'heading.max' => 'The heading may not be greater than 255 characters.',

            'text.required' => 'The text field is required.',
            'text.string' => 'The text must be a string.',
            'text.max' => 'The text may not be greater than 255 characters.',

            'photo.image' => 'The photo must be an image',
            'photo.mime' => 'The photo must be one of the following type: jpg, jpeg, png, gif, svg or webp',
            'photo.max' => 'The image size must be less than or equal to 5 MB.'
        ];
    }
}
