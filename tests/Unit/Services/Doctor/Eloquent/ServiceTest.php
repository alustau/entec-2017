<?php
namespace Tests\Unit\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Creatable;
use App\Models\Doctor;
use App\Services\Doctor\Eloquent\Service;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\Helper;

class ServiceTest extends TestCase
{
    use DatabaseTransactions, Helper;

    protected $service;


    public function setUp()
    {
        parent::setUp();

        $this->service = new Service(new Doctor);
    }

    /**
     * @test
     * @return void
     */
    public function it_is_instance_of_listable()
    {
        $this->assertInstanceOf(Listable::class, $this->service);
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
    public function it_list_all_doctors()
    {
        $this->createDoctor();

        $doctors = $this->service->all();

        $this->assertCount(3, $doctors);

        $this->assertInstanceOf(Collection::class, $doctors);
    }

    /**
     * @test
     * @return void
     */
    public function it_create_a_new_doctor()
    {
        $data = factory(Doctor::class)
            ->make()
            ->toArray();

        $doctor = $this->service->create($data);

        $this->assertEquals(1, Doctor::count());

        $this->assertInstanceOf(Doctor::class, $doctor);
    }
}