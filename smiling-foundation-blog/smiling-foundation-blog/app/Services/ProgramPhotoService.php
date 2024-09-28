<?php

namespace App\Services;

use App\Models\Program;
use App\Models\ProgramPhoto;
use App\Services\Core\BaseModelService;

class ProgramPhotoService extends BaseModelService
{
    public function model(): string
    {
        return ProgramPhoto::class;
    }

    public function getProgramPhotos(Program $program)
    {
        return $this->model()::orderBy('id', 'desc')->where('program_id', $program->id)->get();
    }

    public function deleteProgramPhoto(Program $program, ProgramPhoto $programPhoto) 
    {
        if (isset($program, $programPhoto->photo)) {
            $filePath = public_path('storage/uploads/photo/' . $programPhoto->photo);
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }            
        $isDeleted = $programPhoto->delete();
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
