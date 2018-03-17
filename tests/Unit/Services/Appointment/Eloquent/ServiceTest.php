<?php
namespace Tests\Unit\Services\Appointment\Eloquent;

use App\Contracts\Appointment\Listable;
use App\Contracts\Appointment\Deletable;
use App\Contracts\Appointment\Creatable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Appointment\Eloquent\Service;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Helper;

class ServiceTest extends TestCase
{
    use DatabaseTransactions, Helper;

    protected $service;

    protected $appointment;

    public function setUp()
    {
        parent::setUp();

        $this->appointment = new Appointment;

        $this->service = new Service($this->appointment);
    }

    /**
     * @test
     */
    public function it_implements_listable()
    {
        $this->assertInstanceOf(Listable::class, $this->service);
    }

    /**
     * @test
     */
    public function it_list_all_appointments()
    {
        $this->createAppointment();

        $appointments = $this->service->all();

        $this->assertCount(3, $appointments);

        $this->assertInstanceOf(Collection::class, $appointments);
    }

    /**
     * @test
     */
    public function it_implements_creatable()
    {
        $this->assertInstanceOf(Creatable::class, $this->service);
    }


    /**
     * @test
     * @return void
     */
    public function it_creates_a_new_appointment()
    {
        $doctor = $this->createDoctor(1)->first();

        $appointment = $this->service->create([
            'doctor_id'    => $doctor->id,
            'patient_name' => 'Denis Alustau',
        ]);

        $this->assertEquals(1, $this->appointment->count());

        $this->assertArrayHasKey('id', $appointment);

        $this->assertInstanceOf(Appointment::class, $appointment);
    }


    /**
     * @test
     */
    public function it_implements_deletable()
    {
        $this->assertInstanceOf(Deletable::class, $this->service);
    }


    /**
     * @test
     * @return void
     */
    public function it_delete_a_appointment()
    {
        $appointment = factory(Appointment::class)->create();

        $deleted = $this->service->delete($appointment->id);

        $this->assertTrue($deleted);

        $this->assertEquals(0, Appointment::count());
        $this->assertEquals(1, Doctor::count());

        $this->assertEmpty($this->appointment->find($appointment->id));
    }
}
