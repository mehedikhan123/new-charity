<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CounterService;
use App\Services\FeatureService;
use App\Services\HomePageItemService;
use App\Services\About\AboutService;
use App\Services\FacilityService;

class AboutController extends Controller
{
    protected CounterService $counterService;
    protected AboutService $aboutService;
    protected FeatureService $featureService;
    protected FacilityService $facilityService;
    protected HomePageItemService $homePageItemService;

    public function __construct(CounterService $counterService, AboutService $aboutService, FeatureService $featureService, FacilityService $facilityService, HomePageItemService $homePageItemService)
    {
        $this->counterService = $counterService;
        $this->aboutService = $aboutService;
        $this->featureService = $featureService;
        $this->facilityService = $facilityService;
        $this->homePageItemService = $homePageItemService;
    }

    public function index()
    {
        $counters = $this->counterService->getCounter();
        $aboutSections = $this->aboutService->getActiveAboutSections();
        $features = $this->featureService->getRecentActiveFeatures();
        $facilities = $this->facilityService->getRecentActiveFacilities();
        $homePageItem = $this->homePageItemService->getHomePageItem();

        $validatedData = [
            'counters' => $counters,
            'aboutSections' => $aboutSections,
            'features' => $features,
            'facilities' => $facilities,
            'homePageItem' => $homePageItem
        ];

        return view('front.about.index', $validatedData);
    }

    public function history()
    {
        // $counters = $this->counterService->getCounter();
        $historySections = $this->aboutService->getHistorySections();
        // $features = $this->featureService->getRecentActiveFeatures();
        // $facilities = $this->facilityService->getRecentActiveFacilities();
        // $homePageItem = $this->homePageItemService->getHomePageItem();

        $validatedData = [
            // 'counters' => $counters,
            'historySections' => $historySections,
            // 'features' => $features,
            // 'facilities' => $facilities,
            // 'homePageItem' => $homePageItem
        ];

        return view('front.about.history', $validatedData);
    }
}
