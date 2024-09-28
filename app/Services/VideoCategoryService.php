<?php

namespace App\Services;

use App\Models\VideoCategory;
use App\Services\Core\BaseModelService;
use Illuminate\Support\Facades\DB;

class VideoCategoryService extends BaseModelService
{
    public function model(): string
    {
        return VideoCategory::class;
    }

    public function getVideoCategories()
    {
        return $this->model()::all();
    }

    public function getActiveVideoCategories()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->get();
    }

    public function deleteVideoCategory(VideoCategory $videoCategory) 
    {
        $result = DB::transaction(function () use ($videoCategory) {
            $videoCategory->videos()->delete();
            $isDeleted = $videoCategory->delete();
            return $isDeleted;
        });
        return $result;
    }
}
