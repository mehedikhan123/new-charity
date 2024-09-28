<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMapSettingRequest extends FormRequest
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
            'map_heading' => 'nullable|string|max:255',
            'map_sub_heading' => 'nullable|string|max:255',
            'map_1_country_name' => 'nullable|string|max:255',
            'map_2_country_name' => 'nullable|string|max:255',
            'map_1_country_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'map_2_country_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'map_1' => 'nullable|string',
            'map_2' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'map_heading.string' => 'The map\'s heading field must be a string.',
            'map_heading.max' => 'The map\'s heading may not be greater than 255 characters.',

            'map_sub_heading.string' => 'The map\'s sub heading field must be a string.',
            'map_sub_heading.max' => 'The map\'s sub-heading may not be greater than 255 characters.',

            'map_1_country_name.string' => 'The first map\'s country name field must be a string.',
            'map_1_country_name.max' => 'The first map\'s country name may not be greater than 255 characters.',

            'map_2_country_name.string' => 'The first map\'s country name field must be a string.',
            'map_2_country_name.max' => 'The first map\'s country name may not be greater than 255 characters.',

            'map_1_country_photo.image' => 'The first map\'s country photo must be an image.',
            'map_1_country_photo.mimes' => 'The first map\'s country photo must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'map_1_country_photo.max' => 'The first map\'s country photo must not be greater than 2MB.',

            'map_2_country_photo.image' => 'The last map\'s country photo must be an image.',
            'map_2_country_photo.mimes' => 'The last map\'s country photo must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'map_2_country_photo.max' => 'The last map\'s country photo must not be greater than 2MB.',

            'map_1.string' => 'The first map must be a string.',
            'map_2.string' => 'The last map must be a string.'
        ];
    }
}
