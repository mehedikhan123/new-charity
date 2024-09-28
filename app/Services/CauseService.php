<?php

namespace App\Services;

use App\Models\Cause;
use App\Services\Core\BaseModelService;

class CauseService extends BaseModelService
{
    public function model(): string
    {
        return Cause::class;
    }

    public function getCauses()
    {
        return $this->model()::all();
    }

    public function getFeaturedCauses()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_featured','yes')->get();
    }

    // public function getRecentActiveCauses()
    // {
    //     return $this->model()::orderBy('id', 'desc')->where('is_featured','yes')->take(5)->get();
    // }
}
