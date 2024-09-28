<?php

namespace App\Services;

use App\Models\Country;
use App\Services\Core\BaseModelService;

class CountryService extends BaseModelService
{
    public function model(): string
    {
        return Country::class;
    }

    public function getCountries()
    {
        return $this->model()::all();
    }
}
