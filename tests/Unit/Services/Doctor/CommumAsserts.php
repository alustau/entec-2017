<?php
namespace Tests\Unit\Services\Doctor;


use App\Contracts\Doctor\Deletable;
use App\Contracts\Doctor\Updatable;

trait CommumAsserts
{
    /**
     * @param $doctor
     */
    protected function hasDoctorAttribute($doctor)
    {
        $this->assertArrayHasKey('id', $doctor);
        $this->assertArrayHasKey('name', $doctor);
        $this->assertArrayHasKey('specialty', $doctor);
        $this->assertArrayHasKey('registry', $doctor);
    }
}
