<?php

namespace App\Services;

use App\Models\Admin;
use App\Services\Core\BaseModelService;

class AdminService extends BaseModelService
{
    public function model(): string
    {
        return Admin::class;
    }

    public function getAdmin()
    {
        return $this->model()::first();
    }
}
