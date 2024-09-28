<?php

namespace App\Http\Requests\Volunteer;

use Illuminate\Foundation\Http\FormRequest;

class StoreVolunteerRequest extends FormRequest
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
            'title' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'dob' => 'required|date',
            'age' => 'required|integer|min:0',
            'occupation' => 'required|string',
            'institute' => 'nullable|string',
            'phone' => 'required|unique:volunteers,phone',
            'email' => 'required|email|unique:volunteers,email',
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'post_code' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'skills' => 'nullable|array|max:255',
            'experiences' => 'nullable|string',
            'bring_change' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
            'title.string' => 'Title must be a string',
            'first_name.required' => 'First name is required',
            'first_name.string' => 'First name must be a string',
            'last_name.required' => 'Last name is required',
            'last_name.string' => 'Last name must be a string',
            'dob.required' => 'Date of birth is required',
            'dob.date' => 'Date of birth must be a valid date',
            'age.required' => 'Age is required',
            'age.integer' => 'Age must be an integer',
            'age.min' => 'Age must be at least 0',
            'occupation.required' => 'Occupation is required',
            'occupation.string' => 'Occupation must be a string',
            'institute.string' => 'Institute must be a string',
            'phone.required' => 'Phone number is required',
            'phone.unique' => 'Phone number must be unique',
            'email.required' => 'Email address is required',
            'email.email' => 'Email address must be a valid email',
            'email.unique' => 'Email address must be unique',
            'street.required' => 'Street address is required',
            'street.string' => 'Street address must be a string',
            'city.required' => 'City is required',
            'city.string' => 'City must be a string',
            'state.required' => 'State is required',
            'state.string' => 'State must be a string',
            'post_code.required' => 'Postal code is required',
            'post_code.string' => 'Postal code must be a string',
            'country_id.required' => 'Country is required',
            'country_id.exists' => 'Selected country does not exist',
            'skills.array' => 'The skills must be an array.',
            'skills.max' => 'The skills may not be greater than 255 characters.',
            'experiences.string' => 'Experiences must be a string',
            'bring_change.string' => 'Bring Change must be a string',
            'photo.required' => 'The photo field is required.',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.'
        ];
    }
}
