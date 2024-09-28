<?php

namespace App\Services;

use App\Models\Appeal;
use App\Models\AppealVideo;
use App\Services\Core\BaseModelService;

class AppealVideoService extends BaseModelService
{
    public function model(): string
    {
        return AppealVideo::class;
    }

    public function getAppealVideos(Appeal $appeal)
    {
        return $this->model()::orderBy('id', 'desc')->where('appeal_id', $appeal->id)->get();
    }

    public function deleteAppealVideo(Appeal $appeal, AppealVideo $appealVideo) 
    {
        if(isset($appeal)) {
            $isDeleted = $appealVideo->delete();
            return $isDeleted;
        }
    }

    public function createVideos(array $validatedData)
    {
        $createdVideos = []; 

        foreach ($validatedData['video'] as $videoId) {;
            $validatedData['video'] = $videoId;
            $video = $this->create($validatedData);
            $createdVideos[] = $video;
        }

        return $createdVideos;
    }
}
