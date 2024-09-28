<?php

namespace App\Http\Requests\Facility;

use Illuminate\Foundation\Http\FormRequest;

class StoreFacilityRequest extends FormRequest
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
            'icon' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'text' => 'required|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'icon.required' => 'The icon field is required.',
            'icon.string' => 'The icon must be a string.',
            'icon.max' => 'The icon must not be greater than 255 characters.',
            
            'heading.required' => 'The heading field is required.',
            'heading.string' => 'The heading must be a string.',
            'heading.max' => 'The heading must not be greater than 255 characters.',

            'text.required' => 'The text field is required.',
            'text.string' => 'The text must be a string.',
            'text.max' => 'The text may not be greater than 255 characters.'
        ];
    }
}
