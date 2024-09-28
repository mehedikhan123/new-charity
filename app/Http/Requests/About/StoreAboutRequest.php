<?php

namespace App\Http\Requests\About;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutRequest extends FormRequest
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
    public function rules()
    {
        return [
            'heading' => 'required|string|max:255',
            'category_id' => 'required|exists:about_categories,id',
            'text' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'heading.required' => 'The heading field is required.',
            'heading.string' => 'The heading field must be a string.',
            'heading.max' => 'The heading may not be greater than 255 characters.',

            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category does not exist',

            'text.required' => 'The text field is required.',
            'text.string' => 'The text field must be a string.',

            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
