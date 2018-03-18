<?php
namespace Tests\Unit\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Deletable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\Eloquent\DeleterService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Helper;

class DeleterServiceTest extends TestCase
{
    use DatabaseTransactions, Helper;

    protected $service;


    public function setUp()
    {
        parent::setUp();

        $this->doctor = new Doctor;

        $this->service = new DeleterService($this->doctor);
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
     * @test
     * @return void
     */
    public function it_delete_a_doctor()
    {
        $doctor = factory(Appointment::class)->create()->doctor;

        $deleted = $this->service->delete($doctor->id);

        $this->assertTrue($deleted);

        $this->assertEquals(0, Appointment::where('doctor_id', $doctor->id)->count());

        $this->assertEmpty($this->doctor->find($doctor->id));
    }
}
