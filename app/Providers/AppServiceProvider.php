<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        \PagSeguro\Library::initialize();
        //\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
        //\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

    }
}
