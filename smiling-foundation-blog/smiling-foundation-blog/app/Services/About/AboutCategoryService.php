<?php

namespace App\Services\About;

use App\Models\AboutCategory;
use App\Services\Core\BaseModelService;
use Illuminate\Support\Facades\DB;

class AboutCategoryService extends BaseModelService
{
    public function model(): string
    {
        return AboutCategory::class;
    }

    public function getAboutCategories()
    {
        return $this->model()::all();
    }

    public function getActiveAboutCategories()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->get();
    }

    public function deleteAboutCategory(AboutCategory $aboutCategory) 
    {
        $result = DB::transaction(function () use ($aboutCategory) {
            if(isset($aboutCategory->abouts)) {
                foreach ($aboutCategory->abouts as $categoryPhoto) {
                    $filePath = public_path('storage/uploads/photo/' . $categoryPhoto->photo);
                    
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }            
            }
            $aboutCategory->abouts()->delete();
            $isDeleted = $aboutCategory->delete();
            return $isDeleted;
        });
        return $result;
    }
}
