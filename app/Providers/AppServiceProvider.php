<?php

namespace App\Providers;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Deletable;
use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Updatable;
use App\Services\Doctor\Eloquent\Service as DoctorEloquentService;
use App\Services\Doctor\QueryBuilder\Service as DoctorQueryBuilderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $type = 'Query Builder';

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
        switch ($this->type) {
            case 'Eloquent':
                $this->registerDoctorEloquent();
                break;
            case 'Query Builder':
                $this->registerDoctorQueryBuilder();
                break;
        }
    }

    protected function registerDoctorEloquent()
    {
        $this->app->bind(Listable::class, DoctorEloquentService::class);
        $this->app->bind(Creatable::class, DoctorEloquentService::class);
        $this->app->bind(Updatable::class, DoctorEloquentService::class);
        $this->app->bind(Deletable::class, DoctorEloquentService::class);
    }

    protected function registerDoctorQueryBuilder()
    {
        $this->app->bind(Listable::class, DoctorQueryBuilderService::class);
        $this->app->bind(Creatable::class, DoctorQueryBuilderService::class);
        $this->app->bind(Updatable::class, DoctorQueryBuilderService::class);
//        $this->app->bind(Deletable::class, DoctorQueryBuilderService::class);

//        $this->app->bind(Updatable::class, DoctorEloquentService::class);
        $this->app->bind(Deletable::class, DoctorEloquentService::class);
    }
}
