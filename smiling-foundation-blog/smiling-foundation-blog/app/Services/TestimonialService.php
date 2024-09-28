<?php

namespace App\Services;

use App\Models\Testimonial;
use App\Services\Core\BaseModelService;

class TestimonialService extends BaseModelService
{
    public function model(): string
    {
        return Testimonial::class;
    }

    public function getTestimonials()
    {
        return $this->model()::all();
    }

    public function getRecentActiveTestimonials()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->take(3)->get();
    }
}
