<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Appeal;
use App\Models\AppealPhoto;
use App\Models\AppealVideo;
use App\Services\AppealService;

class AppealController extends Controller
{
    protected AppealService $appealService;

    public function __construct(AppealService $appealService)
    {
        $this->appealService = $appealService;
    }

    public function index()
    {
        $appeals = $this->appealService->getActiveAppeals();

        $validatedData = [
            'appeals' => $appeals
        ];

        return view('front.appeal.index', $validatedData);
    }

    public function show(Appeal $appeal)
    {
        $appealPhotos = AppealPhoto::where('appeal_id',$appeal->id)->get();
        $appealVideos = AppealVideo::where('appeal_id',$appeal->id)->get();
        $responseData = [
            'appeal' => $appeal,
            'appealPhotos' => $appealPhotos,
            'appealVideos' => $appealVideos
        ];
        return view('front.appeal.show', $responseData);
    }
}
