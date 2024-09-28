<?php

namespace App\Http\Requests\Photo\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoCategoryRequest extends FormRequest
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
        $photoCategoryId = $this->route('photo_category')->id;
        return [
            'name' => 'required|unique:photo_categories,name,' . $photoCategoryId
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Category name is required',
            'name.unique' => 'Category name must be unique'
        ];
    }
}
