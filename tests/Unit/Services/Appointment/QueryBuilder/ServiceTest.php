<?php
namespace Tests\Unit\Services\Appointment\QueryBuilder;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Appointment\QueryBuilder\Service;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Appointment\CommumTests;
use Tests\Unit\Services\Helper;

class ServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumTests;

    protected $service;

    protected $appointment;

    public function setUp()
    {
        parent::setUp();

        $this->appointment = new Appointment;

        $this->service = new Service;
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
    public function it_creates_a_new_appointment()
    {
        $doctor = $this->createDoctor(1)->first();

        $appointment = $this->service->create([
            'doctor_id'    => $doctor->id,
            'patient_name' => 'Denis Alustau',
        ]);

        $this->assertEquals(1, $this->appointment->count());

        $this->assertArrayHasKey('id', (array) $appointment);

        $this->assertInstanceOf(\stdClass::class, $appointment);
    }

}
