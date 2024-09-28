<?php

namespace App\Services;

use App\Models\PhotoCategory;
use App\Services\Core\BaseModelService;
use Illuminate\Support\Facades\DB;

class PhotoCategoryService extends BaseModelService
{
    public function model(): string
    {
        return PhotoCategory::class;
    }

    public function getPhotoCategories()
    {
        return $this->model()::all();
    }

    public function getActivePhotoCategories()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->get();
    }

    public function deletePhotoCategory(PhotoCategory $photoCategory) 
    {
        $result = DB::transaction(function () use ($photoCategory) {
            if(isset($photoCategory->photos)) {
                foreach ($photoCategory->photos as $categoryPhoto) {
                    $filePath = public_path('storage/uploads/photo/' . $categoryPhoto->photo);
                    
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }            
            }
            $photoCategory->photos()->delete();
            $isDeleted = $photoCategory->delete();
            return $isDeleted;
        });
        return $result;
    }
}
