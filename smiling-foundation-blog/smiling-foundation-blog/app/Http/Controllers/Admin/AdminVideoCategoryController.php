<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\Category\StoreVideoCategoryRequest;
use App\Http\Requests\Video\Category\UpdateVideoCategoryRequest;
use App\Models\VideoCategory;
use App\Services\VideoCategoryService;
use Illuminate\Http\Request;

class AdminVideoCategoryController extends Controller
{
    protected VideoCategoryService $videoCategoryService;

    public function __construct(VideoCategoryService $videoCategoryService)
    {
        $this->videoCategoryService = $videoCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videoCategories = $this->videoCategoryService->getVideoCategories();
        $responseData = [
            'videoCategories' => $videoCategories
        ];
        return view('admin.gallery.video.category.index', $responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.video.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVideoCategoryRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $videoCategory = $this->videoCategoryService->create($validatedData);
        $status = $videoCategory ? 'success' : 'error';
        $message = $videoCategory ? 'Video Category created successfully' : 'Video Category could not be created';
        return redirect()->route('admin.gallery.video-category.index')->with($status, $message);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoCategory $videoCategory)
    {
        $responseData = [
            'videoCategory' => $videoCategory
        ];
        return view('admin.gallery.video.category.create', $responseData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVideoCategoryRequest $request, VideoCategory $videoCategory)
    {
        $validatedData = $request->validated();
        $validatedData['slug'] = str()->slug($request->name);
        $isUpdated = $videoCategory->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Video Category updated successfully' : 'Video Category could not be updated';
        return redirect()->route('admin.gallery.video-category.index')->with($status, $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VideoCategory $videoCategory)
    {
        $isDeleted = $this->videoCategoryService->deleteVideoCategory($videoCategory);
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'Video Category deleted successfully' : 'Video Category could not be deleted';
        return redirect()->route('admin.gallery.video-category.index')->with($status, $message);
    }

    public function changeStatus(Request $request, VideoCategory $videoCategory)
    {
        $videoCategory->is_active = $request->is_active ? false : true;
        $isUpdated = $videoCategory->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Video Category status is updated successfully' : 'Video Category status could not be updated successfully';
        return redirect()->route('admin.gallery.video-category.index')->with($status, $message);
    }
}
