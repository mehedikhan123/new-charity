<?php

namespace App\Http\Requests\Counter;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCounterRequest extends FormRequest
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
            'counter1_number' => 'required|string|max:255',
            'counter1_name' => 'required|string|max:255',
            'counter2_number' => 'required|string|max:255',
            'counter2_name' => 'required|string|max:255',
            'counter3_number' => 'required|string|max:255',
            'counter3_name' => 'required|string|max:255',
            'counter4_number' => 'required|string|max:255',
            'counter4_name' => 'required|string|max:255',
            'status' => 'required|string|in:active,inactive'
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
            'counter1_number.required' => 'The counter1 number is required.',
            'counter1_number.string' => 'The counter1 number must be a string.',
            'counter1_number.max' => 'The counter1 number must not be greater than 255 characters.',
            'counter1_name.required' => 'The counter1 name is required.',
            'counter1_name.string' => 'The counter1 name must be a string.',
            'counter1_name.max' => 'The counter1 name must not be greater than 255 characters.',

            'counter2_number.required' => 'The counter2 number is required.',
            'counter2_number.string' => 'The counter2 number must be a string.',
            'counter2_number.max' => 'The counter2 number must not be greater than 255 characters.',
            'counter2_name.required' => 'The counter2 name is required.',
            'counter2_name.string' => 'The counter2 name must be a string.',
            'counter2_name.max' => 'The counter2 name must not be greater than 255 characters.',

            'counter3_number.required' => 'The counter3 number is required.',
            'counter3_number.string' => 'The counter3 number must be a string.',
            'counter3_number.max' => 'The counter3 number must not be greater than 255 characters.',
            'counter3_name.required' => 'The counter3 name is required.',
            'counter3_name.string' => 'The counter3 name must be a string.',
            'counter3_name.max' => 'The counter3 name must not be greater than 255 characters.',

            'counter4_number.required' => 'The counter4 number is required.',
            'counter4_number.string' => 'The counter4 number must be a string.',
            'counter4_number.max' => 'The counter4 number must not be greater than 255 characters.',
            'counter4_name.required' => 'The counter4 name is required.',
            'counter4_name.string' => 'The counter4 name must be a string.',
            'counter4_name.max' => 'The counter4 name must not be greater than 255 characters.',

            'status.required' => 'Status is required.',
            'status.string' => 'The status must be a string.',
            'status.in' => 'The status must be either active or inactive.',
        ];
    }
}
