<?php

namespace App\Services;

use App\Models\Cause;
use App\Models\CausePhoto;
use App\Services\Core\BaseModelService;

class CausePhotoService extends BaseModelService
{
    public function model(): string
    {
        return CausePhoto::class;
    }

    public function getCausePhotos(Cause $cause)
    {
        return $this->model()::orderBy('id', 'desc')->where('cause_id', $cause->id)->get();
    }

    public function deleteCausePhoto(Cause $cause, CausePhoto $causePhoto) 
    {
        if (isset($cause, $causePhoto->photo)) {
            $filePath = public_path('storage/uploads/photo/' . $causePhoto->photo);
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }            
        $isDeleted = $causePhoto->delete();
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
