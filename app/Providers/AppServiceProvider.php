<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
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
        
        try {
            $Setting = Setting::find(1);
            view()->share('settings', $Setting);
        } catch (\Throwable $th) {
            //throw $th;
        }
        // if (Setting::exists()) {
            
        // }

        if (!session()->get('locale')) {
            session()->put('locale', 'ar');
        }
    }
}
