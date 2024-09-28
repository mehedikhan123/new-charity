<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Services\TestimonialService;

class TestimonialController extends Controller
{
    protected TestimonialService $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->testimonialService = $testimonialService;
    }

    public function index()
    {
        // $photoCategories = $this->photoCategoryService->getActivePhotoCategories();
        $testimonials = $this->testimonialService->getTestimonials();
        $validatedData = [
            // 'photoCategories' => $photoCategories,
            'testimonials' => $testimonials
        ];
        return view('front.testimonial.index', $validatedData);
    }

    public function show(Testimonial $testimonial)
    {
        $responseData = [
            'testimonial' => $testimonial
        ];
        return view('front.testimonial.show', $responseData);
    }
}
