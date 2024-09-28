<?php

namespace App\Providers;

use App\Models\PagesBanner;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        $setting_data = Setting::first();
        $banner = PagesBanner::first();
        view()->share([
            'global_setting_data' => $setting_data,
            'global_banner' => $banner
        ]);
    }
}
