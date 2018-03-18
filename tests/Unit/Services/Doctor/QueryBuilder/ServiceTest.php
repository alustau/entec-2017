<?php

namespace Tests\Unit\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Listable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\QueryBuilder\ListService;
use App\Services\Doctor\QueryBuilder\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumTests;
use Tests\Unit\Services\Helper;

class ServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumTests;

    protected $service;

    protected $query;

    public function setUp()
    {
        parent::setUp();

        $this->service = new Service;

        $this->query = DB::getFacadeRoot()->query();
    }


    /**
     * @test
     * @return void
     */
    public function it_is_instance_of_listable()
    {
        $this->assertInstanceOf(Listable::class, new ListService($this->query));
    }

    /**
     * @test
     * @return void
     */
    public function list_all_doctors()
    {
        $this->createDoctor();

        $doctors = (new ListService($this->query))->all();

        $this->assertCount(3, $doctors);

        $this->assertInstanceOf(Collection::class, $doctors);
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

        $this->assertNotEmpty($doctor);

        $this->assertArrayHasKey('id', (array) $doctor);

        $this->assertEquals(1, Doctor::count());

        $this->assertInstanceOf(\stdClass::class, $doctor);
    }

    /**
     * @test
     * @return void
     */
    public function it_updates_a_doctor()
    {
        $doctor = $this->createDoctor(1)->first();

        $updated = $this->service->update($doctor->id, [
            'name' => 'Denis Alustau'
        ]);

        $this->assertTrue($updated);

        $this->assertEquals('Denis Alustau', Doctor::find($doctor->id)->name);
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
