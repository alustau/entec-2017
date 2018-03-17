<?php
namespace App\Contracts\Appointment;


/**
 * Interface Listable
 * @package App\Contracts\Appointment
 */
interface Listable
{
    /**
     * List all appointments
     * @return mixed
     */
    public function all();
}
