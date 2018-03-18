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
}
