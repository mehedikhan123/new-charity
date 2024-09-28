<?php

namespace App\Services;

use App\Models\Feature;
use App\Services\Core\BaseModelService;

class FeatureService extends BaseModelService
{
    public function model(): string
    {
        return Feature::class;
    }

    public function getFeatures()
    {
        return $this->model()::all();
    }

    public function getRecentActiveFeatures()
    {
        return $this->model()::where('is_active', true)->take(3)->get();
    }
}
