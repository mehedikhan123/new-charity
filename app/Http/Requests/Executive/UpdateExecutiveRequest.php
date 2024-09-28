<?php

namespace App\Http\Requests\Executive;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExecutiveRequest extends FormRequest
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
        $executiveId = $this->route('executive')->id;
        return [
            'name' => 'required|string',
            'designation' => 'required|unique:executives,designation,' . $executiveId,
            'phone' => 'required|unique:executives,phone,' . $executiveId,
            'email' => 'required|unique:executives,email,' . $executiveId,
            'country_id' => 'required|exists:countries,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
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
            
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
