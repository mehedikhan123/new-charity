<?php

namespace App\Http\Requests\Cause;

use Illuminate\Foundation\Http\FormRequest;

class StoreCauseRequest extends FormRequest
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
            'short_description' => 'required|string',
            'description' => 'required|string',
            'featured_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'goal' => 'nullable|integer|min:0',
            'raised' => 'nullable|integer|min:0',
            'is_featured' => 'required|in:yes,no',
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


            'short_description.required' => 'The short description field is required.',
            'short_description.string' => 'The short description field must be a string.',

            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string.',

            'featured_photo.required' => 'The featured photo field is required.',
            'featured_photo.image' => 'The featured photo must be an image.',
            'featured_photo.mimes' => 'The featured photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'featured_photo.max' => 'The featured photo must not be greater than 2MB.',

            'goal.integer' => 'The goal amount must be an integer.',
            'goal.min' => 'The goal amount must be at least 0.',

            'raised.integer' => 'The raised amount must be an integer.',
            'raised.min' => 'The raised amount must be at least 0.',

            'is_featured.required' => 'The is featured field is required.',
            'is_featured.in' => 'The is featured field must be one of the following values: yes, no.',
        ];
    }
}
