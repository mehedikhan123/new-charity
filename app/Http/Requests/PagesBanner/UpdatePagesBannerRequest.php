<?php

namespace App\Http\Requests\PagesBanner;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePagesBannerRequest extends FormRequest
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
            'appeal' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'about_history' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'about_who' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'executive' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'volunteer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'program' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'photo_gallery' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video_gallery' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'story' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'testimonial' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'join_volunteer' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'be_sponsor' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'blog' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'news' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'contact' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'appeal.image' => 'The appeal background must be an image file.',
            'appeal.mimes' => 'The appeal background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'appeal.max' => 'The appeal background may not be greater than 5 MB.',

            'about_history.image' => 'The history background must be an image file.',
            'about_history.mimes' => 'The history background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'about_history.max' => 'The history background may not be greater than 5 MB.',

            'about_who.image' => 'The who we are background must be an image file.',
            'about_who.mimes' => 'The who we are background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'about_who.max' => 'The who we are background may not be greater than 5 MB.',

            'executive.image' => 'The executive background must be an image file.',
            'executive.mimes' => 'The executive background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'executive.max' => 'The executive background may not be greater than 5 MB.',

            'volunteer.image' => 'The volunteer background must be an image file.',
            'volunteer.mimes' => 'The volunteer background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'volunteer.max' => 'The volunteer background may not be greater than 5 MB.',

            'program.image' => 'The program background must be an image file.',
            'program.mimes' => 'The program background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'program.max' => 'The program background may not be greater than 5 MB.',

            'photo_gallery.image' => 'The photo gallery background must be an image file.',
            'photo_gallery.mimes' => 'The photo gallery background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'photo_gallery.max' => 'The photo gallery background may not be greater than 5 MB.',

            'video_gallery.image' => 'The video gallery background must be an image file.',
            'video_gallery.mimes' => 'The video gallery background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'video_gallery.max' => 'The video gallery background may not be greater than 5 MB.',

            'story.image' => 'The story background must be an image file.',
            'story.mimes' => 'The story background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'story.max' => 'The story background may not be greater than 5 MB.',

            'testimonial.image' => 'The testimonial background must be an image file.',
            'testimonial.mimes' => 'The testimonial background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'testimonial.max' => 'The testimonial background may not be greater than 5 MB.',

            'join_volunteer.image' => 'The join volunteer background must be an image file.',
            'join_volunteer.mimes' => 'The join volunteer background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'join_volunteer.max' => 'The join volunteer background may not be greater than 5 MB.',

            'be_sponsor.image' => 'The be sponsor background must be an image file.',
            'be_sponsor.mimes' => 'The be sponsor background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'be_sponsor.max' => 'The be sponsor background may not be greater than 5 MB.',

            'blog.image' => 'The blog background must be an image file.',
            'blog.mimes' => 'The blog background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'blog.max' => 'The blog background may not be greater than 5 MB.',

            'news.image' => 'The news background must be an image file.',
            'news.mimes' => 'The news background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'news.max' => 'The news background may not be greater than 5 MB.',

            'contact.image' => 'The contact background must be an image file.',
            'contact.mimes' => 'The contact background must be a file of type: jpg, jpeg, png, gif,svg,webp.',
            'contact.max' => 'The contact background may not be greater than 5 MB.'
        ];
    }
}
