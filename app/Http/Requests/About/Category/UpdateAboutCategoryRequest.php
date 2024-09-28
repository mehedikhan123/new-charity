<?php

namespace App\Http\Requests\About\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutCategoryRequest extends FormRequest
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
        $aboutCategoryId = $this->route('about_category')->id;
        return [
            'name' => 'required|unique:about_categories,name,' . $aboutCategoryId
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
