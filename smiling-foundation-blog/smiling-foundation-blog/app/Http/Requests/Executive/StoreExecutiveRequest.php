<?php

namespace App\Http\Requests\Executive;

use Illuminate\Foundation\Http\FormRequest;

class StoreExecutiveRequest extends FormRequest
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
            'name' => 'required|string',
            'designation' => 'required|unique:executives,designation',
            'phone' => 'required|unique:executives,phone',
            'email' => 'required|unique:executives,email',
            'country_id' => 'required|exists:countries,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',

            'designation.required' => 'Designation is required',
            'designation.unique' => 'Designation must be unique',

            'phone.required' => 'Phone number is required',
            'phone.unique' => 'Phone number must be unique',

            'email.required' => 'Email address is required',
            'email.unique' => 'Email address must be unique',

            'country_id.required' => 'Country is required',
            'country_id.exists' => 'Country does not exist',
            
            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
