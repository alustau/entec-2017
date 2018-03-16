<?php
namespace App\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Updatable;
use App\Models\Doctor;

class Service implements Listable, Creatable, Updatable
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

    /**
     * Update a doctor
     * @param $doctor
     * @param $data
     * @return bool
     */
    public function update($doctor, $data): bool
    {
        if (! $doctor instanceof Doctor) {
            $doctor = $this->doctor->find($doctor);
        }

        return $doctor->update($data);
    }
}
