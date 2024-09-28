<?php

namespace App\Http\Requests\Feature;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeatureRequest extends FormRequest
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
            'heading' => 'required|string|max:255',
            'counter' => 'nullable|integer|min:0',
            'text' => 'required|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'heading.required' => 'The heading field is required.',
            'heading.string' => 'The heading must be a string.',
            'heading.max' => 'The heading must not be greater than 255 characters.',

            'counter.integer' => 'The counter must be an integer.',
            'counter.min' => 'The counter may not be smaller than 0.',

            'text.required' => 'The text field is required.',
            'text.string' => 'The text must be a string.',
            'text.max' => 'The text may not be greater than 255 characters.',

            'button_text.string' => 'The button text must be a string.',
            'button_text.max' => 'The button text may not be greater than 255 characters.',

            'button_link.url' => 'The button link must be an url.',
            'button_link.max' => 'The button link may not be greater than 255 characters.'
        ];
    }
}
