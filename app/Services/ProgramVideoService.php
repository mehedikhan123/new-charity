<?php

namespace App\Services;

use App\Models\Program;
use App\Models\ProgramVideo;
use App\Services\Core\BaseModelService;

class ProgramVideoService extends BaseModelService
{
    public function model(): string
    {
        return ProgramVideo::class;
    }

    public function getProgramVideos(Program $program)
    {
        return $this->model()::orderBy('id', 'desc')->where('program_id', $program->id)->get();
    }

    public function deleteProgramVideo(Program $program, ProgramVideo $programVideo) 
    {
        if(isset($program)) {
            $isDeleted = $programVideo->delete();
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
