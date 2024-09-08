<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ComanyInfo;
use View;

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
        $data['settings']   = ComanyInfo::first();
         View::share($data);
    }
}
