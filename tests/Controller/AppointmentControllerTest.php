<?php
namespace Tests\Controller;

use App\Doctor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppointmentControllerTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     * @return void
     */
    public function index_action()
    {
        $response = $this->get(route('appointments.index'));

        $response->assertSuccessful();

        $response->assertSeeText('Appointments list');

        $response->assertViewHas('appointments');
    }


    /**
     * @test
     * @return void
     */
    public function create_action()
    {
        $response = $this->get(route('appointment.create'));

        $response->assertSuccessful();

        $response->assertSeeText('Appointment Form');

        $response->assertViewHas('doctors');
    }


    /**
     * @test
     * @return void
     */
    public function store_action_with_valid_params()
    {
        $doctor = factory(Doctor::class)->create();

        $response = $this->post(route('appointment.save'), [
            'doctor_id'    => $doctor->id,
            'patient_name' => 'Denis Alustau',
        ]);

        $response->assertSessionHas('flash_messenger', [
            'type'    => 'success',
            'message' => 'Appointement has been created'
        ]);

        $response->assertRedirect(route('appointments.index'));
    }


    /**
     * @test
     * @return void
     */
    public function store_action_with_invalid_params()
    {
        $response = $this->post(route('appointment.save'), []);

        $response->assertSessionHas('errors');

        $response->assertRedirect(route('appointment.create'));

        $response->assertSessionHasErrors([
            'doctor_id'    => 'The doctor id field is required.',
            'patient_name' => 'The patient name field is required.',
        ]);
    }
}
