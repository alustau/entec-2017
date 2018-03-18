<?php
namespace App\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Deletable;
use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Updatable;
use App\Models\Doctor;

class Service implements Updatable, Deletable
{
    use Helper;

    protected $doctor;

    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    /**
     * Update a doctor
     * @param $doctor
     * @param $data
     * @return bool
     */
    public function update($doctor, $data): bool
    {
        $doctor = $this->find($doctor);

        return $doctor->update($data);
    }

    /**
     * Delete a doctor and its appointments
     * @param $id
     * @return mixed
     */
    public function delete($id): bool
    {
        $doctor = $this->find($id);

        $doctor->appointments()->delete();

        return $doctor->delete();
    }
}
