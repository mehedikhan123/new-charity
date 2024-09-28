<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterSettingRequest extends FormRequest
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
            'footer_address' => 'nullable|string|max:255',
            'footer_phone' => 'nullable|string|max:20',
            'footer_email' => 'nullable|email|max:255',
            'footer_logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'copyright' => 'nullable|string|max:255'   
        ];
    }

    public function messages(): array
    {
        return [
            'footer_address.string' => 'The footer address must be a string.',
            'footer_address.max' => 'The footer address may not be greater than 255 characters.',
            
            'footer_phone.string' => 'The footer phone number must be a string.',
            'footer_phone.max' => 'The footer phone number may not be greater than 20 characters.',
            
            'footer_email.email' => 'The footer email must be a valid email address.',
            'footer_email.max' => 'The footer email may not be greater than 255 characters.',

            'footer_logo.image' => 'The footer logo must be an image file.',
            'footer_logo.mimes' => 'The footer logo must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'footer_logo.max' => 'The footer logo may not be greater than 5 MB.',

            'facebook.url' => 'The Facebook URL must be a valid URL.',
            'facebook.max' => 'The Facebook URL may not be greater than 255 characters.',
            
            'twitter.url' => 'The Twitter URL must be a valid URL.',
            'twitter.max' => 'The Twitter URL may not be greater than 255 characters.',
            
            'youtube.url' => 'The YouTube URL must be a valid URL.',
            'youtube.max' => 'The YouTube URL may not be greater than 255 characters.',
            
            'linkedin.url' => 'The LinkedIn URL must be a valid URL.',
            'linkedin.max' => 'The LinkedIn URL may not be greater than 255 characters.',
            
            'instagram.url' => 'The Instagram URL must be a valid URL.',
            'instagram.max' => 'The Instagram URL may not be greater than 255 characters.',
            
            'copyright.string' => 'The copyright must be a string.',
            'copyright.max' => 'The copyright may not be greater than 255 characters.'
        ];
    }
}
