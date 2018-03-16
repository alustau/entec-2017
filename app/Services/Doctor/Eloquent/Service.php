<?php
namespace App\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use App\Models\Doctor;

class Service implements Listable, Creatable
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

    /**
     * Create a doctor
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->doctor->create($data);
    }
}
