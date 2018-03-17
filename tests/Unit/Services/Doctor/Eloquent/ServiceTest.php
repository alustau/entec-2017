<?php
namespace Tests\Unit\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Updatable;
use App\Contracts\Doctor\Deletable;
use App\Models\Appointment;
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

    protected $doctor;

    public function setUp()
    {
        parent::setUp();

        $this->doctor = new Doctor;

        $this->service = new Service($this->doctor);
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

        $this->assertArrayHasKey('id', $doctor);

        $this->assertInstanceOf(Doctor::class, $doctor);
    }


    /**
     * @test
     * @return void
     */
    public function it_is_instance_of_updatable()
    {
        $this->assertInstanceOf(Updatable::class, $this->service);
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

        $this->assertEquals('Denis Alustau', $this->doctor->find($doctor->id)->name);
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
        $doctor = $this->createDoctor(1)->first();

        $deleted = $this->service->delete($doctor->id);

        $this->assertTrue($deleted);

        $this->assertEquals(0, Appointment::where('doctor_id', $doctor->id)->count());

        $this->assertEmpty($this->doctor->find($doctor->id));
    }
}
