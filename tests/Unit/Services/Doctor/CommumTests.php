<?php
namespace Tests\Unit\Services\Doctor;


use App\Contracts\Doctor\Deletable;
use App\Contracts\Doctor\Updatable;

trait CommumTests
{
    protected $doctor;

    /**
     * @test
     * @return void
     */
    public function it_is_instance_of_updatable()
    {
        $this->assertInstanceOf(Updatable::class, $this->service);
    }

    /**
     * @test
     * @return void
     */
    public function it_is_instance_of_deletable()
    {
        $this->assertInstanceOf(Deletable::class, $this->service);
    }

    /**
     * @param $doctor
     */
    protected function hasDoctorAttribute($doctor)
    {
        $this->assertObjectHasAttribute('id', $doctor);
        $this->assertObjectHasAttribute('name', $doctor);
        $this->assertObjectHasAttribute('specialty', $doctor);
        $this->assertObjectHasAttribute('registry', $doctor);
    }
}
