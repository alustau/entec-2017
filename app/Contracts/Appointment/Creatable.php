<?php
namespace App\Contracts\Appointment;


/**
 * Interface Creatable
 * @package App\Contracts\Appointment
 */
interface Creatable
{
    /**
     * Create a Appointment
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
}
