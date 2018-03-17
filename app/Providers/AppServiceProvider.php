<?php

namespace App\Providers;

use App\Contracts\Appointment\Creatable as AppointmentCreatable;
use App\Contracts\Appointment\Deletable as AppointmentDeletable;
use App\Contracts\Appointment\Listable as AppointmentListable;
use App\Contracts\Doctor\Creatable as DoctorCreatable;
use App\Contracts\Doctor\Deletable as DoctorDeletable;
use App\Contracts\Doctor\Listable  as DoctorListable;
use App\Contracts\Doctor\Updatable as DoctorUpdatable;
use App\Services\Appointment\Eloquent\Service as AppointmentEloquentService;
use App\Services\Appointment\QueryBuilder\Service as AppointmentQueryBuilderService;
use App\Services\Doctor\Eloquent\Service as DoctorEloquentService;
use App\Services\Doctor\QueryBuilder\Service as DoctorQueryBuilderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $type = 'Query Builder';

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
                $this->registerAppointmentEloquent();
                break;
            case 'Query Builder':
                $this->registerDoctorQueryBuilder();
                $this->registerAppointmentQueryBuilder();
                break;
        }
    }

    protected function registerDoctorEloquent()
    {
        $this->app->bind(DoctorListable::class, DoctorEloquentService::class);
        $this->app->bind(DoctorCreatable::class, DoctorEloquentService::class);
        $this->app->bind(DoctorUpdatable::class, DoctorEloquentService::class);
        $this->app->bind(DoctorDeletable::class, DoctorEloquentService::class);
    }

    protected function registerDoctorQueryBuilder()
    {
        $this->app->bind(DoctorListable::class, DoctorQueryBuilderService::class);
        $this->app->bind(DoctorCreatable::class, DoctorQueryBuilderService::class);
        $this->app->bind(DoctorUpdatable::class, DoctorQueryBuilderService::class);
        $this->app->bind(DoctorDeletable::class, DoctorQueryBuilderService::class);
    }

    protected function registerAppointmentEloquent()
    {
        $this->app->bind(AppointmentListable::class, AppointmentEloquentService::class);
        $this->app->bind(AppointmentCreatable::class, AppointmentEloquentService::class);
        $this->app->bind(AppointmentDeletable::class, AppointmentEloquentService::class);
    }

    protected function registerAppointmentQueryBuilder()
    {
        $this->app->bind(AppointmentListable::class, AppointmentQueryBuilderService::class);
        $this->app->bind(AppointmentCreatable::class, AppointmentQueryBuilderService::class);
        $this->app->bind(AppointmentDeletable::class, AppointmentQueryBuilderService::class);
    }
}
