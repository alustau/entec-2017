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
use App\Services\Doctor\Eloquent\CreatorService as DoctorEloquentCreatorService;
use App\Services\Doctor\Eloquent\ListService as DoctorEloquentListService;
use App\Services\Doctor\Eloquent\UpdaterService as DoctorEloquentUpdaterService;
use App\Services\Doctor\QueryBuilder\ListService as DoctorQueryBuilderListService;
use App\Services\Doctor\QueryBuilder\CreatorService as DoctorQueryBuilderCreatorService;
use App\Services\Doctor\Eloquent\DeleterService as DoctorEloquentService;
use App\Services\Doctor\QueryBuilder\Service as DoctorQueryBuilderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    protected $type = 'Eloquent';

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
        $this->app->bind(DoctorListable::class, DoctorEloquentListService::class);
        $this->app->bind(DoctorCreatable::class, DoctorEloquentCreatorService::class);
        $this->app->bind(DoctorUpdatable::class, DoctorEloquentUpdaterService::class);
        $this->app->bind(DoctorDeletable::class, DoctorEloquentService::class);
    }

    protected function registerDoctorQueryBuilder()
    {
        $query = DB::getFacadeRoot()->query();

        $lister = new DoctorQueryBuilderListService($query);

        $this->app->bind(DoctorListable::class, function () use ($lister) {
            return $lister;
        });

        $this->app->bind(DoctorCreatable::class, function () use ($query, $lister) {
            return new DoctorQueryBuilderCreatorService($query, $lister);
        });

        $this->app->bind(DoctorUpdatable::class, function () use ($query) {
            return new DoctorQueryBuilderService($query);
        });

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
