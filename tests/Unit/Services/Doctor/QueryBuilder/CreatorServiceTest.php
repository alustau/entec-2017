<?php

namespace Tests\Unit\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\QueryBuilder\ListService;
use App\Services\Doctor\QueryBuilder\DeleterService;
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
    use DatabaseTransactions, Helper, CommumAsserts;

    protected $service;

    protected $query;

    protected $list;

    public function setUp()
    {
        parent::setUp();

        $this->query = DB::getFacadeRoot()->query();

        $this->list = $this->prophesize(Listable::class);

        $this->service = new CreatorService($this->query, $this->list->reveal());
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

        $this->list->last()
            ->shouldBeCalled()
            ->willReturn(array_merge($data, ['id' => 1]));

        $doctor = $this->service->create($data);

        $this->assertNotEmpty($doctor);

        $this->hasDoctorAttribute($doctor);

        $this->assertEquals(1, Doctor::count());

        $this->assertTrue(is_array($doctor));
    }
}
