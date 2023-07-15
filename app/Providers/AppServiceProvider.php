<?php

namespace App\Providers;

use Illuminate\Contracts\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
		
		
		Paginator::useBootstrap();
        Schema::defaultStringLength(191);
		
		$settings = Setting::getStettingsOrCreate();
		View()->share(['settings' => $settings]);
		
    }
}
