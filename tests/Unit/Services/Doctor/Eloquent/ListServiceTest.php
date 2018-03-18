<?php
namespace Tests\Unit\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Listable;
use App\Models\Doctor;
use App\Services\Doctor\Eloquent\ListService;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Helper;

class ListServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumAsserts;

    protected $service;


    public function setUp()
    {
        parent::setUp();

        $this->doctor = new Doctor();

        $this->list = new ListService($this->doctor);
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
    public function it_list_all_doctors()
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
