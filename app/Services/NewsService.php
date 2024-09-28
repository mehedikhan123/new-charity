<?php

namespace App\Services;

use App\Models\News;
use App\Services\Core\BaseModelService;

class NewsService extends BaseModelService
{
    public function model(): string
    {
        return News::class;
    }

    // public function getPosts()
    // {
    //     return $this->model()::with('rPostCategory')->get();
    // }

    public function getRecentActiveNews()
    {
        return $this->model()::orderBy('id', 'desc')->take(3)->get();
    }
}
