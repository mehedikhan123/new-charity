<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\OtherPageItemService;

class TermsController extends Controller
{
    protected OtherPageItemService $otherPageItemService;

    public function __construct(OtherPageItemService $otherPageItemService)
    {
        $this->otherPageItemService = $otherPageItemService;
    }

    public function index()
    {
        $terms = $this->otherPageItemService->getOtherPageItem();
        $validatedData = [
            'terms' => $terms
        ];
        return view('front.terms', $validatedData);
    }
}
