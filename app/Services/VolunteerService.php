<?php

namespace App\Services;

use App\Models\Volunteer;
use App\Services\Core\BaseModelService;

class VolunteerService extends BaseModelService
{
    public function model(): string
    {
        return Volunteer::class;
    }

    public function getVolunteers()
    {
        return $this->model()::all();
    }

    public function getActiveVolunteers()
    {
        return $this->model()::where('is_active', true)->paginate(20);
    }

    public function getVolunteer(Volunteer $volunteer)
    {
        return $this->model()::where('id', $volunteer)->first();
    }
}
