<?php
namespace App\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Listable;
use App\Models\Doctor;

class Service implements Listable
{
    protected $doctor;

    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * List all doctors
     * @return mixed
     */
    public function all()
    {
        return $this->doctor->all();
    }
}