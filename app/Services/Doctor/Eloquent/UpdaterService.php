<?php
namespace App\Services\Doctor\Eloquent;


use App\Contracts\Doctor\Updatable;
use App\Models\Doctor;

class UpdaterService extends ServiceAbstract implements Updatable
{
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