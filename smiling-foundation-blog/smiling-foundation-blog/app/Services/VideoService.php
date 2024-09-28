<?php

namespace App\Services;

use App\Services\Core\BaseModelService;
use App\Models\Video;

class VideoService extends BaseModelService
{
    public function model(): string
    {
        return Video::class;
    }

    public function getVideos()
    {
        return $this->model()::orderBy('id', 'desc')->with('videoCategory')->get();
    }

    public function getActiveVideos()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->with('videoCategory')->paginate(20);
    }

    public function createVideos(array $validatedData)
    {
        $createdVideos = []; 

        foreach ($validatedData['video'] as $videoId) {
            $validatedData['video'] = $videoId;
            $video = $this->create($validatedData);
            $createdVideos[] = $video;
        }

        return $createdVideos;
    }
}


