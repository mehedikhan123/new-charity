<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Video\StoreVideoRequest;
use App\Http\Requests\Video\UpdateVideoRequest;
use App\Models\Video;
use App\Services\VideoCategoryService;
use App\Services\VideoService;
use Illuminate\Http\Request;

class AdminVideoController extends Controller
{
    protected VideoService $videoService;
    protected VideoCategoryService $videoCategoryService;

    public function __construct(VideoService $videoService, VideoCategoryService $videoCategoryService)
    {
        $this->videoService = $videoService;
        $this->videoCategoryService = $videoCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = $this->videoService->getVideos();
        $responseData = [
            'videos' => $videos
        ];
        return view('admin.gallery.video.index', $responseData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $videoCategories = $this->videoCategoryService->getActiveVideoCategories();
        $responseData = [
            'videoCategories' => $videoCategories
        ];
        return view('admin.gallery.video.create', $responseData);
    }

    public function store(StoreVideoRequest $request)
    {
        $validatedData = $request->validated();
        $video = $this->videoService->createVideos($validatedData);
        $status = $video ? 'success' : 'error';
        $message = $video ? 'Video is created successfully' : 'Video could not be created';
        return redirect()->route('admin.gallery.video.index')->with($status, $message);
    }

    public function edit(Video $video)
    {
        $videoCategories = $this->videoCategoryService->getActiveVideoCategories();
        $responseData = [
            'video' => $video,
            'videoCategories' => $videoCategories
        ];
        return view('admin.gallery.video.create', $responseData);
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $validatedData = $request->validated();
        $isUpdated = $this->videoService->update($video, $validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Video is updated successfully' : 'Video could not be updated';
        return redirect()->route('admin.gallery.video.index')->with($status, $message);
    }

    public function destroy(Video $video)
    {
        $isDeleted = $video->delete();
        $status = $isDeleted ? 'success' : 'error';
        $message = $isDeleted ? 'video is deleted successfully' : 'video could not be deleted';
        return redirect()->back()->with($status, $message);
    }

    public function changeStatus(Request $request, Video $video)
    {
        $video->is_active = $request->is_active ? false : true;
        $isUpdated = $video->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Video status is updated successfully' : 'Video status could not be updated successfully';
        return redirect()->route('admin.gallery.video.index')->with($status, $message);
    }
}
