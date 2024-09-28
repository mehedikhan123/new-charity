<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\StorePhotoRequest;
use App\Http\Requests\Photo\UpdatePhotoRequest;
use App\Models\Photo;
use App\Services\Core\HelperService;
use App\Services\PhotoCategoryService;
use App\Services\PhotoService;
use Illuminate\Http\Request;

class AdminPhotoController extends Controller
{
    protected PhotoService $photoService;
    protected PhotoCategoryService $photoCategoryService;

    public function __construct(PhotoService $photoService, PhotoCategoryService $photoCategoryService)
    {
        $this->photoService = $photoService;
        $this->photoCategoryService = $photoCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = $this->photoService->getPhotos();
        $responseData = [
            'photos' => $photos
        ];
        return view('admin.gallery.photo.index', $responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $photoCategories = $this->photoCategoryService->getActivePhotoCategories();
        $responseData = [
            'photoCategories' => $photoCategories
        ];
        return view('admin.gallery.photo.create', $responseData);
    }

    public function store(StorePhotoRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['photo'] = HelperService::uploadPhotos(request()->file('photo'), 'gallery_photo');
        $photo = $this->photoService->createPhotos($validatedData);
        $status = $photo ? 'success' : 'error';
        $message = $photo ? 'Photo is created successfully' : 'Photo could not be created';
        return redirect()->route('admin.gallery.photo.index')->with($status, $message);
    }

    public function edit(Photo $photo)
    {
        $photoCategories = $this->photoCategoryService->getActivePhotoCategories();
        $responseData = [
            'photo' => $photo,
            'photoCategories' => $photoCategories
        ];
        return view('admin.gallery.photo.create', $responseData);
    }

    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        $validatedData = $request->validated();
        if($request->hasFile('photo')) {
            $validatedData['photo'] = HelperService::uploadPhoto(request()->file('photo'), 'gallery_photo', $photo->photo);
        }
        $isUpdated = $this->photoService->update($photo, $validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Photo is updated successfully' : 'Photo could not be updated';
        return redirect()->route('admin.gallery.photo.index')->with($status, $message);
    }

    public function destroy(Photo $photo)
    {
        if(isset($photo) && isset($photo->photo)) {
            unlink(public_path('storage/uploads/photo/'. $photo->photo));
        }
        $isDeleted = $photo->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Photo is deleted successfully' : 'Photo could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Photo $photo)
    {
        $photo->is_active = $request->is_active ? false : true;
        $isUpdated = $photo->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Photo status is updated successfully' : 'Photo status could not be updated successfully';
        return redirect()->route('admin.gallery.photo.index')->with($status, $message);
    }
}
