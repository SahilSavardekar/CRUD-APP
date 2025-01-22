<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    // protected $listen = [
    //     \App\Events\ProductEvent::class => [
    //         \App\Listeners\ProductListener::class,
    //     ],
    // ];

    protected $listen = [
        \App\Events\deleteProduct::class => [
            \App\Listeners\deleteListener::class
        ],

        \App\Events\SendMail::class => [
            \App\Listeners\MailListener::class
        ],
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
