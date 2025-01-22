<?php

namespace App\Providers;

// namespace App\Events\ProductEvent;

use App\Models\Products;
use Illuminate\Support\ServiceProvider;
use App\Observers\deletedData;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
