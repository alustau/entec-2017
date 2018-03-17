<?php
namespace App\Contracts\Doctor;


/**
 * Interface Creatable
 * @package App\Contracts\Doctor
 */
interface Creatable
{
    /**
     * Create a doctor
     * @param array $data
     * @return mixed
     */
    public function create(array $data);
}
