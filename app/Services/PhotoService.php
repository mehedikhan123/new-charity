<?php

namespace App\Services;

use App\Services\Core\BaseModelService;
use App\Models\Photo;

class PhotoService extends BaseModelService
{
    public function model(): string
    {
        return Photo::class;
    }

    public function getPhotos()
    {
        return $this->model()::orderBy('id', 'desc')->with('photoCategory')->get();
    }

    public function getActivePhotos()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->with('photoCategory')->paginate(20);
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
