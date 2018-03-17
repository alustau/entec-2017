<?php
namespace App\Contracts\Appointment;


/**
 * Interface Deletable
 * @package App\Contracts\Appointment
 */
interface Deletable
{
    /**
     * Delete a Appointment
     * @param $id
     * @return mixed
     */
    public function delete($id): bool;
}
