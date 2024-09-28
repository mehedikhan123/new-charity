<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactSettingRequest extends FormRequest
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
            'contact_address_1' => 'nullable|string|max:255',
            'contact_phone_1' => 'nullable|string|max:20',
            'contact_email_1' => 'nullable|email|max:255',
            'contact_address_2' => 'nullable|string|max:255',
            'contact_phone_2' => 'nullable|string|max:20',
            'contact_email_2' => 'nullable|email|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'contact_address_1.string' => 'The first contact address must be a string.',
            'contact_address_1.max' => 'The first contact address may not be greater than 255 characters.',
            
            'contact_phone_1.string' => 'The first contact phone number must be a string.',
            'contact_phone_1.max' => 'The first contact phone number may not be greater than 20 characters.',
            
            'contact_email_1.email' => 'The first contact email must be a valid email address.',
            'contact_email_1.max' => 'The first contact email may not be greater than 255 characters.',

            'contact_address_2.string' => 'The second contact address must be a string.',
            'contact_address_2.max' => 'The second contact address may not be greater than 255 characters.',
            
            'contact_phone_2.string' => 'The second contact phone number must be a string.',
            'contact_phone_2.max' => 'The second contact phone number may not be greater than 20 characters.',
            
            'contact_email_2.email' => 'The second contact email must be a valid email address.',
            'contact_email_2.max' => 'The second contact email may not be greater than 255 characters.'
        ];
    }
}
