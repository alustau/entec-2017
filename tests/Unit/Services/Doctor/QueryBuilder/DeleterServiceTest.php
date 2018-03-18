<?php

namespace Tests\Unit\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Deletable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\QueryBuilder\DeleterService;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Helper;

class DeleterServiceTest extends TestCase
{
    use DatabaseTransactions, Helper;

    protected $service;

    protected $query;

    public function setUp()
    {
        parent::setUp();

        $query = DB::getFacadeRoot()->query();

        $this->service = new DeleterService($query);
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
    public function it_deletes_a_doctor()
    {
        $doctor = $this->createAppointment(1)->first()->doctor;
//        dd(Appointment::all()->toArray(), $doctor->toArray());
        $deleted = $this->service->delete($doctor->id);

        $this->assertTrue($deleted);

        $this->assertEquals(0, Appointment::where('doctor_id', $doctor->id)->count());

        $this->assertEmpty(Doctor::find($doctor->id));
    }
}
