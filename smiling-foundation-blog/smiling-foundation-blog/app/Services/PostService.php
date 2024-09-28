<?php

namespace App\Services;

use App\Models\Post;
use App\Services\Core\BaseModelService;

class PostService extends BaseModelService
{
    public function model(): string
    {
        return Post::class;
    }

    // public function getPosts()
    // {
    //     return $this->model()::with('rPostCategory')->get();
    // }

    public function getRecentActivePosts()
    {
        return $this->model()::orderBy('id', 'desc')->take(3)->get();
    }
}
