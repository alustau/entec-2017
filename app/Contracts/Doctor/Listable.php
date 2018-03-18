<?php
namespace App\Contracts\Doctor;


/**
 * Interface Listable
 * @package App\Contracts\Doctor
 */
interface Listable
{
    /**
     * List all doctors
     * @return mixed
     */
    public function all();

    /**
     * List the last doctor inserted
     * @return mixed
     */
    public function last(): array;
}
