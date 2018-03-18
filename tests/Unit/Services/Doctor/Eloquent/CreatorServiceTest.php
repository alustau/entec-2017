<?php
namespace Tests\Unit\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\Eloquent\ListService;
use App\Services\Doctor\Eloquent\CreatorService;
use App\Services\Doctor\Eloquent\Service;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Doctor\CommumTests;
use Tests\Unit\Services\Helper;

class CreatorServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumAsserts;

    protected $service;


    public function setUp()
    {
        parent::setUp();

        $this->doctor = new Doctor();

        $this->service =new CreatorService($this->doctor);
    }

    /**
     * @test
     * @return void
     */
    public function it_is_instance_of_creatable()
    {
        $this->assertInstanceOf(Creatable::class, $this->service);
    }

    /**
     * @test
     * @return void
     */
    public function it_creates_a_new_doctor()
    {
        $data = factory(Doctor::class)
            ->make()
            ->toArray();

        $doctor = $this->service->create($data);

        $this->assertEquals(1, $this->doctor->count());

        $this->hasDoctorAttribute($doctor);

        $this->assertTrue(is_array($doctor));
    }
}
