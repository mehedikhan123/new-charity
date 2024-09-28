<?php

namespace App\Http\Requests\Faq;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFaqRequest extends FormRequest
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
    public function rules()
    {
        return [
            'question' => 'required|string|max:255',
            'answer' => 'required|string'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'question.required' => 'The question is required.',
            'question.string' => 'The question must be a string.',
            'question.max' => 'The question must not be greater than 255 characters.',

            'answer.required' => 'The answer field is required.',
            'answer.string' => 'The answer field must be a string.'
        ];
    }
}
