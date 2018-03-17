<?php
namespace Tests\Unit\Services\Appointment;


use App\Contracts\Appointment\Creatable;
use App\Contracts\Appointment\Deletable;
use App\Contracts\Appointment\Listable;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Collection;

trait CommumTests
{
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
    public function it_implements_creatable()
    {
        $this->assertInstanceOf(Creatable::class, $this->service);
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