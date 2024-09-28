<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PagesBanner\UpdatePagesBannerRequest;
use App\Models\PagesBanner;
use App\Services\Core\HelperService;
use App\Services\PagesBannerService;

class AdminPagesBannerController extends Controller
{
    protected PagesBannerService $pagesBannerService;

    public function __construct(PagesBannerService $pagesBannerService)
    {
        $this->pagesBannerService = $pagesBannerService;
    }

    public function index()
    {
        $pagesBanner = $this->pagesBannerService->getPagesBanner();
        $responseData = [
            'pagesBanner' => $pagesBanner
        ];
        return view('admin.banner.index', $responseData);
    }

    public function pagesBanner(UpdatePagesBannerRequest $request, PagesBanner $pagesBanner = null)
    {
        $validatedData = $request->validated();
        if($request->hasFile('appeal')) {
            $validatedData['appeal'] = HelperService::uploadPhoto(request()->file('appeal'), 'pages_banner_appeal', $pagesBanner->appeal ?? null);
        }
        if($request->hasFile('about_history')) {
            $validatedData['about_history'] = HelperService::uploadPhoto(request()->file('about_history'), 'pages_banner_about_history', $pagesBanner->about_history ?? null);
        }
        if($request->hasFile('about_who')) {
            $validatedData['about_who'] = HelperService::uploadPhoto(request()->file('about_who'), 'pages_banner_about_who', $pagesBanner->about_who ?? null);
        }
        if($request->hasFile('executive')) {
            $validatedData['executive'] = HelperService::uploadPhoto(request()->file('executive'), 'pages_banner_executive', $pagesBanner->executive ?? null);
        }
        if($request->hasFile('volunteer')) {
            $validatedData['volunteer'] = HelperService::uploadPhoto(request()->file('volunteer'), 'pages_banner_volunteer', $pagesBanner->volunteer ?? null);
        }
        if($request->hasFile('program')) {
            $validatedData['program'] = HelperService::uploadPhoto(request()->file('program'), 'pages_banner_program', $pagesBanner->program ?? null);
        }
        if($request->hasFile('photo_gallery')) {
            $validatedData['photo_gallery'] = HelperService::uploadPhoto(request()->file('photo_gallery'), 'pages_banner_photo_gallery', $pagesBanner->photo_gallery ?? null);
        }
        if($request->hasFile('video_gallery')) {
            $validatedData['video_gallery'] = HelperService::uploadPhoto(request()->file('video_gallery'), 'pages_banner_video_gallery', $pagesBanner->video_gallery ?? null);
        }
        if($request->hasFile('story')) {
            $validatedData['story'] = HelperService::uploadPhoto(request()->file('story'), 'pages_banner_story', $pagesBanner->story ?? null);
        }
        if($request->hasFile('testimonial')) {
            $validatedData['testimonial'] = HelperService::uploadPhoto(request()->file('testimonial'), 'pages_banner_testimonial', $pagesBanner->testimonial ?? null);
        }
        if($request->hasFile('join_volunteer')) {
            $validatedData['join_volunteer'] = HelperService::uploadPhoto(request()->file('join_volunteer'), 'pages_banner_join_volunteer', $pagesBanner->join_volunteer ?? null);
        }
        if($request->hasFile('be_sponsor')) {
            $validatedData['be_sponsor'] = HelperService::uploadPhoto(request()->file('be_sponsor'), 'pages_banner_be_sponsor', $pagesBanner->be_sponsor ?? null);
        }
        if($request->hasFile('blog')) {
            $validatedData['blog'] = HelperService::uploadPhoto(request()->file('blog'), 'pages_banner_blog', $pagesBanner->blog ?? null);
        }
        if($request->hasFile('news')) {
            $validatedData['news'] = HelperService::uploadPhoto(request()->file('news'), 'pages_banner_news', $pagesBanner->news ?? null);
        }
        if($request->hasFile('contact')) {
            $validatedData['contact'] = HelperService::uploadPhoto(request()->file('contact'), 'pages_banner_contact', $pagesBanner->contact ?? null);
        }
        if($request->hasFile('donate')) {
            $validatedData['donate'] = HelperService::uploadPhoto(request()->file('donate'), 'pages_banner_donate', $pagesBanner->donate ?? null);
        }
        
        if(!$pagesBanner) {
            $pagesBanner = $this->pagesBannerService->create($validatedData);
            $status = $pagesBanner ? 'success' : 'error';
            $message = $pagesBanner ? 'Page banners created successfully' : 'Page banners could not be created successfully';
        } else {
            $isUpdated = $pagesBanner->update($validatedData);
            $status = $isUpdated ? 'success' : 'error';
            $message = $isUpdated ? 'Page banners updated successfully' : 'Page banners could not be updated successfully';
        }
        return redirect()->back()->with($status, $message);
    }
}
