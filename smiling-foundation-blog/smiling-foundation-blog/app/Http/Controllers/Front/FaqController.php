<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\FaqService;

class FaqController extends Controller
{
    protected FaqService $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index()
    {
        $faqs = $this->faqService->getFaqs();
        $validatedData = [
            'faqs' => $faqs
        ];
        return view('front.faqs', $validatedData);
    }
}
