<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeoSettingRequest extends FormRequest
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
            'seo_company_name' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_short_description' => 'nullable|string|max:255',   
            'seo_keywords' => 'nullable|array|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'seo_company_name.string' => 'The company name must be a string.',
            'seo_company_name.max' => 'The company name may not be greater than 255 characters.',

            'seo_title.string' => 'The title must be a string.',
            'seo_title.max' => 'The title may not be greater than 255 characters.',

            'seo_short_description.string' => 'The short description must be a string.',
            'seo_short_description.max' => 'The short description may not be greater than 255 characters.',

            'seo_keywords.array' => 'The keywords must be an array.',
            'seo_keywords.max' => 'The keywords may not be greater than 255 characters.'
        ];
    }
}
