<?php
namespace App\Services\Doctor\Eloquent;


trait Helper
{
    /**
     * @param $doctor
     * @return mixed
     */
    protected function find($doctor)
    {
        if (!$doctor instanceof Doctor) {
            $doctor = $this->doctor->find($doctor);
        }

        return $doctor;
    }
}