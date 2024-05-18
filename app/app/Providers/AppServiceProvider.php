<?php

namespace App\Providers;
//use App\Models\Notification;
// use Illuminate\Support\Facades\Schema;
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
        // Schema::defaultStringLength(191);
        //$get_notifications=Notification::get();
        //View::share(['get_notifications'=>$get_notifications]);
    }
}
