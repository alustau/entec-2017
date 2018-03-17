<?php

namespace App\Providers;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Deletable;
use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Updatable;
use App\Services\Doctor\Eloquent\Service;
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
        $this->app->bind(Listable::class, Service::class);
        $this->app->bind(Creatable::class, Service::class);
        $this->app->bind(Updatable::class, Service::class);
        $this->app->bind(Deletable::class, Service::class);
    }
}
