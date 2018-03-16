<?php
namespace App\Contracts\Doctor;


/**
 * Interface Updatable
 * @package App\Contracts\Doctor
 */
interface Updatable
{
    /**
     * Update a doctor
     * @param $doctor
     * @param $data
     * @return bool
     */
    public function update($doctor, $data): bool;
}