<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CauseService;
use App\Services\ProgramService;
use App\Services\FeatureService;
use App\Services\HomePageItemService;
use App\Services\PostService;
use App\Services\SliderService;
use App\Services\About\AboutService;
use App\Services\AppealService;
use App\Services\ExecutiveService;
use App\Services\FacilityService;
use App\Services\TestimonialService;

class HomeController extends Controller
{
    protected SliderService $sliderService;
    protected AboutService $aboutService;
    protected FeatureService $featureService;
    protected FacilityService $facilityService;
    protected AppealService $appealService;
    protected HomePageItemService $homePageItemService;
    protected TestimonialService $testimonialService;
    protected CauseService $causeService;
    protected ProgramService $programService;
    protected ExecutiveService $executiveService;
    protected PostService $postService;

    public function __construct(SliderService $sliderService, AboutService $aboutService, FeatureService $featureService, FacilityService $facilityService, AppealService $appealService, HomePageItemService $homePageItemService, TestimonialService $testimonialService, CauseService $causeService, ProgramService $programService, ExecutiveService $executiveService, PostService $postService)
    {
        $this->sliderService = $sliderService;
        $this->featureService = $featureService;
        $this->aboutService = $aboutService;
        $this->facilityService = $facilityService;
        $this->appealService = $appealService;
        $this->homePageItemService = $homePageItemService;
        $this->testimonialService = $testimonialService;
        $this->causeService = $causeService;
        $this->programService = $programService;
        $this->executiveService = $executiveService;
        $this->postService = $postService;
    }

    public function index()
    {
        $slider = $this->sliderService->getRecentActiveSliders();
        $features = $this->featureService->getRecentActiveFeatures();
        $about = $this->aboutService->getAboutSection();
        $facilities = $this->facilityService->getRecentActiveFacilities();
        $appeals = $this->appealService->getRecentActiveAppeals();
        $appeal = $this->appealService->getAppeal();
        // $homePageItem = $this->homePageItemService->getHomePageItem();
        $income = $this->aboutService->getIncomeSection();
        $testimonials = $this->testimonialService->getTestimonials();
        $featuredCauses = $this->causeService->getFeaturedCauses();
        $programs = $this->programService->getRecentActivePrograms();
        $executives = $this->executiveService->getRecentActiveExecutives();
        $posts = $this->postService->getRecentActivePosts();

        $validatedData = [
            'slider' => $slider,
            'features' => $features,
            'about' => $about,
            'facilities' => $facilities,
            'appeals' => $appeals,
            'appeal' => $appeal,
            'income' => $income,
            // 'homePageItem' => $homePageItem,
            'testimonials' => $testimonials,
            'featuredCauses' => $featuredCauses,
            'programs' => $programs,
            'executives' => $executives,
            'posts' => $posts
        ];

        return view('front.home', $validatedData);
    }
}
