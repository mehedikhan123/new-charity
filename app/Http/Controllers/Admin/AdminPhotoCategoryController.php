<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Photo\Category\StorePhotoCategoryRequest;
use App\Http\Requests\Photo\Category\UpdatePhotoCategoryRequest;
use App\Models\PhotoCategory;
use App\Services\PhotoCategoryService;
use Illuminate\Http\Request;

class AdminPhotoCategoryController extends Controller
{
    protected PhotoCategoryService $photoCategoryService;

    public function __construct(PhotoCategoryService $photoCategoryService)
    {
        $this->photoCategoryService = $photoCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photoCategories = $this->photoCategoryService->getPhotoCategories();
        $responseData = [
            'photoCategories' => $photoCategories
        ];
        return view('admin.gallery.photo.category.index', $responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.photo.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $photoCategory = $this->photoCategoryService->create($validatedData);
        $status = $photoCategory ? 'success' : 'error';
        $message = $photoCategory ? 'Photo Category created successfully' : 'Photo Category could not be created';
        return redirect()->route('admin.gallery.photo-category.index')->with($status, $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhotoCategory $photoCategory)
    {
        $responseData = [
            'photoCategory' => $photoCategory
        ];
        return view('admin.gallery.photo.category.create', $responseData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoCategoryRequest $request, PhotoCategory $photoCategory)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $isUpdated = $photoCategory->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Photo Category updated successfully' : 'Photo Category could not be updated';
        return redirect()->route('admin.gallery.photo-category.index')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoCategory $photoCategory)
    {
        $isDeleted = $this->photoCategoryService->deletePhotoCategory($photoCategory);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Photo Category deleted successfully' : 'Photo Category could not be deleted';
        return redirect()->route('admin.gallery.photo-category.index')->with($status, $message);
    }

    public function changeStatus(Request $request, PhotoCategory $photoCategory)
    {
        $photoCategory->is_active = $request->is_active ? false : true;
        $isUpdated = $photoCategory->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Photo Category status is updated successfully' : 'Photo Category status could not be updated successfully';
        return redirect()->route('admin.gallery.photo-category.index')->with($status, $message);
    }
}
