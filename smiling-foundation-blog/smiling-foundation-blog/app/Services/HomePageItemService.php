<?php

namespace App\Services;

use App\Models\HomePageItem;
use App\Services\Core\BaseModelService;

class HomePageItemService extends BaseModelService
{
    public function model(): string
    {
        return HomePageItem::class;
    }

    public function getHomePageItem()
    {
        return $this->model()::first();
    }
}
