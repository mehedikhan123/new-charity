<?php

namespace App\Services\About;

use App\Models\About;
use App\Services\Core\BaseModelService;

class AboutService extends BaseModelService
{
    public function model(): string
    {
        return About::class;
    }

    public function getAboutSections()
    {
        return $this->model()::all();
    }

    public function getAboutSection()
    {
        return $this->model()::where('is_active', true)->with('aboutCategories')
        ->whereHas('aboutCategories', function ($query) {
            $query->where('slug', 'who-we-are');
        })
        ->first();    
    }

    public function getHistorySections()
    {
        return $this->model()::where('is_active', true)->with('aboutCategories')
        ->whereHas('aboutCategories', function ($query) {
            $query->where('slug', 'history');
        })
        ->get();    
    }

    public function getIncomeSection()
    {
        return $this->model()::where('is_active', true)->with('aboutCategories')
        ->whereHas('aboutCategories', function ($query) {
            $query->where('slug', 'income');
        })
        ->first();    
    }

    public function getActiveAboutSections()
    {
        return $this->model()::where('is_active', true)->with('aboutCategories')
        ->whereHas('aboutCategories', function ($query) {
            $query->where('slug', 'who-we-are');
        })->get();
    }
}
