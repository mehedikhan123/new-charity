<?php

namespace App\Services;

use App\Models\Faq;
use App\Services\Core\BaseModelService;

class FaqService extends BaseModelService
{
    public function model(): string
    {
        return Faq::class;
    }

    public function getFaqs()
    {
        return $this->model()::all();
    }
}
