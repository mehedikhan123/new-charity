<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OtherPageItem;
use App\Services\OtherPageItemService;

class AdminOtherPageController extends Controller
{
    protected OtherPageItemService $otherPageItemService;

    public function __construct(OtherPageItemService $otherPageItemService)
    {
        $this->otherPageItemService = $otherPageItemService;
    }

    public function terms()
    {
        $terms = $this->otherPageItemService->getOtherPageItem();
        $responseData = [
            'terms' => $terms
        ];
        return view('admin.other-pages.terms', $responseData);
    }

    public function termsUpdate(Request $request, OtherPageItem $otherPageItem)
    {
        $otherPageItem->terms_content = $request->terms_content;
        $isUpdated = $otherPageItem->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Terms & Conditions updated successfully' : 'Terms & Conditions could not be updated successfully';
        return redirect()->back()->with($status, $message);
    }

    public function privacy()
    {
        $privacy = $this->otherPageItemService->getOtherPageItem();
        $responseData = [
            'privacy' => $privacy
        ];
        return view('admin.other-pages.privacy', $responseData);
    }

    public function privacyUpdate(Request $request, OtherPageItem $otherPageItem)
    {
        $otherPageItem->privacy_content = $request->privacy_content;
        $isUpdated = $otherPageItem->save();
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Privacy Policy updated successfully' : 'Privacy Policy could not be updated successfully';
        return redirect()->back()->with($status, $message);
    }
}
