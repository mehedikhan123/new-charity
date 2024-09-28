<?php

namespace App\Services;

use App\Models\Cause;
use App\Models\CauseVideo;
use App\Services\Core\BaseModelService;

class CauseVideoService extends BaseModelService
{
    public function model(): string
    {
        return CauseVideo::class;
    }

    public function getCauseVideos(Cause $cause)
    {
        return $this->model()::orderBy('id', 'desc')->where('cause_id', $cause->id)->get();
    }

    public function deleteCauseVideo(Cause $cause, CauseVideo $causeVideo) 
    {
        if(isset($cause)) {
            $isDeleted = $causeVideo->delete();
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
