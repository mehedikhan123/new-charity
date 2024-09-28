<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\OtherPageItemService;

class PrivacyController extends Controller
{
    protected OtherPageItemService $otherPageItemService;

    public function __construct(OtherPageItemService $otherPageItemService)
    {
        $this->otherPageItemService = $otherPageItemService;
    }

    public function index()
    {
        $privacy = $this->otherPageItemService->getOtherPageItem();
        $validatedData = [
            'privacy' => $privacy
        ];
        return view('front.privacy', $validatedData);
    }
}
