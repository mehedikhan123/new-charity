<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTopbarSettingRequest extends FormRequest
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
            'top_address' => 'nullable|string|max:255',
            'top_phone' => 'nullable|string|max:20',
            'top_email' => 'nullable|email|max:255'    
        ];
    }

    public function messages(): array
    {
        return [
            'top_address.string' => 'The topbar address must be a string.',
            'top_address.max' => 'The topbar address may not be greater than 255 characters.',

            'top_phone.string' => 'The topbar phone number must be a string.',
            'top_phone.max' => 'The topbar phone number may not be greater than 20 characters.',
            
            'top_email.email' => 'The topbar email must be a valid email address.',
            'top_email.max' => 'The topbar email may not be greater than 255 characters.'            
        ];
    }
}
