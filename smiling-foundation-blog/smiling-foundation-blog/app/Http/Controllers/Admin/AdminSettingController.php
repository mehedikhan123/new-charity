<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateContactSettingRequest;
use App\Http\Requests\Setting\UpdateFooterSettingRequest;
use App\Http\Requests\Setting\UpdateMapSettingRequest;
use App\Http\Requests\Setting\UpdatePhotoSettingRequest;
use App\Http\Requests\Setting\UpdateSeoSettingRequest;
use App\Http\Requests\Setting\UpdateTopbarSettingRequest;
use App\Models\Setting;
use App\Services\Core\HelperService;
use App\Services\SettingService;

class AdminSettingController extends Controller
{
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        $settings = $this->settingService->getSettings();
        $responseData = [
            'settings' => $settings
        ];
        return view('admin.settings.index', $responseData);
    }

    public function photoSetting(UpdatePhotoSettingRequest $request, Setting $setting = null)
    {
        $validatedData = $request->validated();
        if($request->hasFile('logo_1')) {
            $validatedData['logo_1'] = HelperService::uploadPhoto(request()->file('logo_1'), 'settings_logo_1', $setting->logo_1 ?? null);
        }

        if($request->hasFile('logo_2')) {
            $validatedData['logo_2'] = HelperService::uploadPhoto($request->file('logo_2'), 'settings_logo_2', $setting->logo_2 ?? null);
        }

        if($request->hasFile('favicon')) {
            $validatedData['favicon'] = HelperService::uploadPhoto($request->file('favicon'), 'settings_favicon', $setting->favicon ?? null);
        }

        if($request->hasFile('banner')) {
            $validatedData['banner'] = HelperService::uploadPhoto($request->file('banner'), 'settings_banner', $setting->banner ?? null);
        }
        
        if(!$setting) {
            $setting = $this->settingService->create($validatedData);
            $status = $setting ? 'success' : 'error';
            $message = $setting ? 'Photo\'s setting is created successfully' : 'Photo\'s setting could not be created successfully';
        } else {
            $isUpdated = $setting->update($validatedData);
            $status = $isUpdated ? 'success' : 'error';
            $message = $isUpdated ? 'Photo\'s setting is updated successfully' : 'Photo\'s setting could not be updated successfully';
        }
        return redirect()->back()->with($status, $message);
    }

    public function seoSetting(UpdateSeoSettingRequest $request, Setting $setting)
    {
        $validatedData = $request->validated();
        $isUpdated = $setting->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Seo\'s setting is updated successfully' : 'Seo\'s setting could not be updated successfully';
        return redirect()->back()->with($status, $message);
    }

    public function topbarSetting(UpdateTopbarSettingRequest $request, Setting $setting)
    {
        $validatedData = $request->validated();
        $isUpdated = $setting->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Topbar\'s setting is updated successfully' : 'Topbar\'s setting could not be updated successfully';
        return redirect()->back()->with($status, $message);
    }

    public function contactSetting(UpdateContactSettingRequest $request, Setting $setting)
    {
        $validatedData = $request->validated();
        $isUpdated = $setting->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Contact\'s setting is updated successfully' : 'Contact\'s setting could not be updated successfully';
        return redirect()->back()->with($status, $message);
    }

    public function footerSetting(UpdateFooterSettingRequest $request, Setting $setting)
    {
        $validatedData = $request->validated();
        if($request->hasFile('footer_logo')) {
            $validatedData['footer_logo'] = HelperService::uploadPhoto(request()->file('footer_logo'), 'settings_footer_logo', $setting->footer_logo ?? null);
        }
        $isUpdated = $setting->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Footer\'s setting is updated successfully' : 'Footer\'s setting could not be updated successfully';
        return redirect()->back()->with($status, $message);
    }

    public function mapSetting(UpdateMapSettingRequest $request, Setting $setting)
    {
        $validatedData = $request->validated();
        if($request->hasFile('map_1_country_photo')) {
            $validatedData['map_1_country_photo'] = HelperService::uploadPhoto($request->file('map_1_country_photo'), 'settings_map_1_country_photo', $setting->map_1_country_photo ?? null);
        }
        if($request->hasFile('map_2_country_photo')) {
            $validatedData['map_2_country_photo'] = HelperService::uploadPhoto($request->file('map_2_country_photo'), 'settings_map_2_country_photo', $setting->map_2_country_photo ?? null);
        }
        $isUpdated = $setting->update($validatedData);
        $status = $isUpdated ? 'success' : 'error';
        $message = $isUpdated ? 'Map\'s setting is updated successfully' : 'Map\'s setting could not be updated successfully';
        return redirect()->back()->with($status, $message);
    }
}
