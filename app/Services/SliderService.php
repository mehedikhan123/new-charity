<?php

namespace App\Services;

use App\Models\Slider;
use App\Services\Core\BaseModelService;

class SliderService extends BaseModelService
{
    public function model(): string
    {
        return Slider::class;
    }

    public function getSliders()
    {
        return $this->model()::all();
    }

    public function getRecentActiveSliders()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->take(3)->get();
    }
}
