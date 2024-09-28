<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Executive;
use App\Services\ExecutiveService;

class ExecutiveController extends Controller
{
    protected ExecutiveService $executiveService;

    public function __construct(ExecutiveService $executiveService)
    {
        $this->executiveService = $executiveService;
    }

    public function index()
    {
        $executives = $this->executiveService->getExecutives();
        $validatedData = [
            'executives' => $executives
        ];
        return view('front.executives', $validatedData);
    }

    public function show(Executive $executive)
    {
        $validatedData = [
            'executive' => $executive
        ];
        return view('front.executive', $validatedData);
    }
}
