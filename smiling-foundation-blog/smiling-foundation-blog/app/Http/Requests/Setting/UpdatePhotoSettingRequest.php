<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoSettingRequest extends FormRequest
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
            'logo_1' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'logo_2' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'logo_1.image' => 'The logo must be an image file.',
            'logo_1.mimes' => 'The logo must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'logo_1.max' => 'The logo may not be greater than 5 MB.',

            'logo_2.image' => 'The logo must be an image file.',
            'logo_2.mimes' => 'The logo must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'logo_2.max' => 'The logo may not be greater than 5 MB.',
            
            'favicon.image' => 'The favicon must be an image file.',
            'favicon.mimes' => 'The favicon must be a file of type: ico, png.',
            'favicon.max' => 'The favicon may not be greater than 1 MB.',
            
            'banner.image' => 'The banner must be an image file.',
            'banner.mimes' => 'The banner must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'banner.max' => 'The banner may not be greater than 5 MB.'
        ];
    }
}
