<?php
namespace App\Services\Appointment\Eloquent;


use App\Contracts\Appointment\Listable;
use App\Models\Appointment;

class Service implements Listable
{

    /**
     * List all appointments
     * @return mixed
     */
    public function all()
    {
        return Appointment::all();
    }
}