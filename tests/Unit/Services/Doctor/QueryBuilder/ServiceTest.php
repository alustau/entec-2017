<?php

namespace Tests\Unit\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\QueryBuilder\Service;
use App\Services\Doctor\QueryBuilder\CreatorService;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Doctor\CommumTests;
use Tests\Unit\Services\Helper;

class ServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumTests, CommumAsserts;

    protected $service;

    protected $query;

    protected $list;

    public function setUp()
    {
        parent::setUp();

        $this->service = new Service;

        $this->query = DB::getFacadeRoot()->query();

        $this->list = $this->prophesize(Listable::class);
    }

    /**
     * @test
     * @return void
     */
    public function it_deletes_a_doctor()
    {
        $doctor = factory(Appointment::class)->create()->doctor;

        $deleted = $this->service->delete($doctor->id);

        $this->assertTrue($deleted);

        $this->assertEquals(0, Appointment::where('doctor_id', $doctor->id)->count());

        $this->assertEmpty(Doctor::find($doctor->id));
    }
}
