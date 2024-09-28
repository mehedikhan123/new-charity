<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\PhotoCategoryService;
use App\Services\PhotoService;

class PhotoController extends Controller
{
    protected PhotoCategoryService $photoCategoryService;
    protected PhotoService $photoService;

    public function __construct(PhotoCategoryService $photoCategoryService, PhotoService $photoService)
    {
        $this->photoCategoryService = $photoCategoryService;
        $this->photoService = $photoService;
    }

    public function index()
    {
        // $photoCategories = $this->photoCategoryService->getActivePhotoCategories();
        $photos = $this->photoService->getActivePhotos();
        $validatedData = [
            // 'photoCategories' => $photoCategories,
            'photos' => $photos
        ];
        return view('front.photo_gallery', $validatedData);
    }
}
