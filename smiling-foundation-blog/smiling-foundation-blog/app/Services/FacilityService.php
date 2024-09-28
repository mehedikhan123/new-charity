<?php

namespace App\Services;

use App\Models\Facility;
use App\Services\Core\BaseModelService;

class FacilityService extends BaseModelService
{
    public function model(): string
    {
        return Facility::class;
    }

    public function getFacilities()
    {
        return $this->model()::all();
    }

    public function getRecentActiveFacilities()
    {
        return $this->model()::where('is_active', true)->take(4)->get();
    }
}
