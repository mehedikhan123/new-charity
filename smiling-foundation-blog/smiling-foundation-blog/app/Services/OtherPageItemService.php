<?php

namespace App\Services;

use App\Models\OtherPageItem;
use App\Services\Core\BaseModelService;

class OtherPageItemService extends BaseModelService
{
    public function model(): string
    {
        return OtherPageItem::class;
    }

    public function getOtherPageItem()
    {
        return $this->model()::first();
    }
}
