<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class providerTest extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind('providerTest1', function()
        {
            return 'プロバイダーテスト';
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
