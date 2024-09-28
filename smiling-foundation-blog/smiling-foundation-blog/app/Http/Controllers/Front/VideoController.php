<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\VideoCategoryService;
use App\Services\VideoService;

class VideoController extends Controller
{
    protected VideoCategoryService $videoCategoryService;
    protected VideoService $videoService;

    public function __construct(VideoCategoryService $videoCategoryService, VideoService $videoService)
    {
        $this->videoCategoryService = $videoCategoryService;
        $this->videoService = $videoService;
    }

    public function index()
    {
        // $videoCategories = $this->videoCategoryService->getVideoCategories();
        $videos = $this->videoService->getActiveVideos();
        $validatedData = [
            // 'videoCategories' => $videoCategories
            'videos' => $videos
        ];
        return view('front.video_gallery', $validatedData);
    }
}
