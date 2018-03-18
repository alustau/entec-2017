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
use Mockery\Mock;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Doctor\CommumTests;
use Tests\Unit\Services\Helper;

class ListServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumAsserts;

    protected $service;

    protected $query;

    protected $list;

    public function setUp()
    {
        parent::setUp();

        $this->service = new Service;

        $query = DB::getFacadeRoot()->query();

        $this->list = new ListService($query);
    }


    /**
     * @test
     * @return void
     */
    public function it_is_instance_of_listable()
    {
        $this->assertInstanceOf(Listable::class, $this->list);
    }

    /**
     * @test
     * @return void
     */
    public function list_all_doctors()
    {
        $this->createDoctor();

        $doctors = $this->list->all();

        $this->assertCount(3, $doctors);

        $this->assertInstanceOf(Collection::class, $doctors);
    }

    /**
     * @test
     * @return void
     */
    public function list_last_doctors()
    {
        $lastDoctor = $this->createDoctor()->last();

        $last = $this->list->last();

        $this->hasDoctorAttribute($last);

        $this->assertEquals($lastDoctor->id, $last['id']);

        $this->assertTrue(is_array($last));
    }
}
