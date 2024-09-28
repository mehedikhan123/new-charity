<?php

namespace App\Http\Requests\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTestimonialRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'comment' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
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
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not be greater than 255 characters.',

            'designation.required' => 'The designation is required.',
            'designation.string' => 'The designation must be a string.',
            'designation.max' => 'The designation must not be greater than 255 characters.',

            'comment.required' => 'The comment field is required.',
            'comment.string' => 'The comment field must be a string.',

            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
