<?php

namespace App\Services;

use App\Models\PagesBanner;
use App\Services\Core\BaseModelService;

class PagesBannerService extends BaseModelService
{
    public function model(): string
    {
        return PagesBanner::class;
    }

    public function getPagesBanner()
    {
        return $this->model()::first();
    }
}
