<?php

namespace Tests\Unit\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\QueryBuilder\ListService;
use App\Services\Doctor\QueryBuilder\Service;
use App\Services\Doctor\QueryBuilder\CreatorService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Doctor\CommumTests;
use Tests\Unit\Services\Helper;

class CreatorServiceTest extends TestCase
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
    public function list_last_doctors()
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
    public function it_is_instance_of_creatable()
    {
        $this->assertInstanceOf(Creatable::class, new CreatorService($this->query, $this->list->reveal()));
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

        $this->list->last()
            ->shouldBeCalled()
            ->willReturn(array_merge($data, ['id' => 1]));

        $doctor = (new CreatorService($this->query, $this->list->reveal()))->create($data);

        $this->assertNotEmpty($doctor);

        $this->hasDoctorAttribute($doctor);

        $this->assertEquals(1, Doctor::count());

        $this->assertTrue(is_array($doctor));
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
