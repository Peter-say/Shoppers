<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

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
        User::observe(UserObserver::class);
        view()->composer('*',function($view){
            $view->with([
                'web_assets' => url('/').env('RESOURCE_URL').'/web',
                'dashboard_assets' => url('/').env('RESOURCE_URL').'/dashboard',

            ]);
        });
    }
}
