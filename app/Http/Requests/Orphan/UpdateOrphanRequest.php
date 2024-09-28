<?php

namespace App\Http\Requests\Orphan;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrphanRequest extends FormRequest
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
        $orphanId = $this->route('orphan')->id;
        return [
            'name' => 'required|string',
            'date_of_birth' => 'required|date',
            'age' => 'required|integer',
            'gender' => 'required|string|in:male,female,others',
            'economic_status' => 'required|string|in:orphan,ultra poor,street children',
            'support_type' => 'required|string|in:food,cloths,home,education,medication',
            'guardian_name' => 'required|string',
            'relationship_with_guardian' => 'required|string',
            'mobile_number' => 'required|string',
            'email_address' => 'required|email|unique:orphans,email_address,' . $orphanId,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|string',
            'village_city' => 'required|string',
            'upazila' => 'required|string',
            'district' => 'required|string',
            'division' => 'required|string',
            'reported_by' => 'required|exists:volunteers,id'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name is required',
            'name.string' => 'Name must be a string',
            'date_of_birth.required' => 'Date of birth is required',
            'date_of_birth.date' => 'Date of birth must be a valid date',
            'age.required' => 'Age is required',
            'age.integer' => 'Age must be an integer',
            'gender.required' => 'Gender is required',
            'gender.string' => 'Gender must be a string',
            'gender.in' => 'Gender must be one of the following: male, female or others',
            'economic_status.required' => 'Economic status is required',
            'economic_status.string' => 'Economic status must be a string',
            'economic_status.in' => 'Economic status must be one of the following: orphan,ultra poor or street children',
            'support_type.required' => 'Support type is required',
            'support_type.string' => 'Support type must be a string',
            'support_type.in' => 'Support type must be one of the following: food, cloths, home, education or medication',
            'guardian_name.required' => 'Guardian name is required',
            'guardian_name.string' => 'Guardian name must be a string',
            'relationship_with_guardian.required' => 'Relation with guardian is required',
            'relationship_with_guardian.string' => 'Relation with guardian must be a string',
            'mobile_number.required' => 'Mobile number is required',
            'mobile_number.string' => 'Mobile number must be a string',
            'email_address.required' => 'Email address is required',
            'email_address.email' => 'Email address must be a valid email',
            'email_address.unique' => 'Email address already exists',
            'photo.image' => 'The photo must be an image.',
            'photo.mimes' => 'The photo must be a file of type: jpeg, png, jpg, gif, svg or webp.',
            'photo.max' => 'The photo must not be greater than 2MB.',
            'description.string' => 'Description must be a string',
            'village_city.required' => 'Village / City is required',
            'village_city.string' => 'Village / City must be a string',
            'upazila.required' => 'Upazilla is required',
            'upazila.string' => 'Upazilla must be a string',
            'district.required' => 'District is required',
            'district.string' => 'District must be a string',
            'division.required' => 'Division is required',
            'division.string' => 'Division must be a string',
            'reported_by.required' => 'Requested person is required',
            'reported_by.exists' => 'Requested person doesn\'t exist'
        ];
    }
}
