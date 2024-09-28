<?php

namespace App\Services;

use App\Models\Counter;
use App\Services\Core\BaseModelService;

class CounterService extends BaseModelService
{
    public function model(): string
    {
        return Counter::class;
    }

    public function getCounter()
    {
        return $this->model()::first();
    }
}
