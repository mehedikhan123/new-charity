<?php

namespace App\Services;

use App\Models\Appeal;
use App\Services\Core\BaseModelService;

class AppealService extends BaseModelService
{
    public function model(): string
    {
        return Appeal::class;
    }

    public function getAppeals()
    {
        return $this->model()::all();
    }

    public function getRecentActiveAppeals()
    {
        return $this->model()::whereNot('id', 1)->orderBy('id', 'desc')->where('is_active', true)->take(6)->get();
    }

    public function getActiveAppeals()
    {
        return $this->model()::whereNot('id', 1)->orderBy('id', 'desc')->where('is_active', true)->paginate(15);
    }

    public function getAppeal()
    {
        return $this->model()::first();
    }
}
