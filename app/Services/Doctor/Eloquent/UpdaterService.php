<?php
namespace App\Services\Doctor\Eloquent;


use App\Contracts\Doctor\Updatable;

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
        $doctor = $this->find($doctor);

        return $doctor->update($data);
    }
}
