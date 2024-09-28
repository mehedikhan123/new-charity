<?php

namespace App\Services;

use App\Models\Program;
use App\Services\Core\BaseModelService;

class ProgramService extends BaseModelService
{
    public function model(): string
    {
        return Program::class;
    }

    public function getAllPrograms()
    {
        return $this->model()::all();
    }

    public function getRecentActivePrograms()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->take(3)->get();
    }

    public function getActivePrograms()
    {
        return $this->model()::orderBy('id', 'desc')->where('is_active', true)->paginate(15);
    }
}
