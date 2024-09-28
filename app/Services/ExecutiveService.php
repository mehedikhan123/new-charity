<?php

namespace App\Services;

use App\Services\Core\BaseModelService;
use App\Models\Executive;

class ExecutiveService extends BaseModelService
{
    public function model(): string
    {
        return Executive::class;
    }

    public function getExecutives()
    {
        return $this->model()::with('country')->get();
    }

    public function getActiveExecutives()
    {
        return $this->model()::with('country')->where('is_active', true)->paginate(15);
    }

    public function getRecentActiveExecutives()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->take(4)->get();
    }
}
