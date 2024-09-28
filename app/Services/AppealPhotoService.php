<?php

namespace App\Services;

use App\Models\Appeal;
use App\Models\AppealPhoto;
use App\Services\Core\BaseModelService;

class AppealPhotoService extends BaseModelService
{
    public function model(): string
    {
        return AppealPhoto::class;
    }

    public function getAppealPhotos(Appeal $appeal)
    {
        return $this->model()::orderBy('id', 'desc')->where('appeal_id', $appeal->id)->get();
    }

    public function deleteAppealPhoto(Appeal $appeal, AppealPhoto $appealPhoto) 
    {
        if (isset($appeal, $appealPhoto->photo)) {
            $filePath = public_path('storage/uploads/photo/' . $appealPhoto->photo);
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }            
        $isDeleted = $appealPhoto->delete();
        return $isDeleted;
    }

    public function createPhotos(array $validatedData)
    {
        $createdPhotos = []; 

        foreach ($validatedData['photo'] as $photoName) {
            $validatedData['photo'] = $photoName;

            $photo = $this->create($validatedData);
            $createdPhotos[] = $photo; 
        }

        return $createdPhotos; 
    }
}
