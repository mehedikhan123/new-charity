<?php

namespace App\Services;

use App\Models\Setting;
use App\Services\Core\BaseModelService;

class SettingService extends BaseModelService
{
    public function model(): string
    {
        return Setting::class;
    }

    public function getSettings()
    {
        return $this->model()::first();
    }
}
