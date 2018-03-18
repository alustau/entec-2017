<?php
namespace Tests\Unit\Controller;

use App\Models\Appointment;
use App\Models\Doctor;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DoctorControllerTest extends TestCase
{
    use WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     * @return void
     */
    public function index_action()
    {
        $response = $this->get(route('doctors.index'));

        $response->assertSuccessful();

        $response->assertSeeText('Doctor list');

        $response->assertViewHas('doctors');
    }

    /**
     * @test
     * @return void
     */
    public function create_action()
    {
        $response = $this->get(route('doctor.create'));

        $response->assertSuccessful();

        $response->assertSeeText('Doctor Form');
    }

    /**
     * @test
     * @return void
     */
    public function store_action_with_valid_params()
    {
        $data = factory(Doctor::class)
            ->make()
            ->toArray();

        $response = $this->post(route('doctor.save'), $data);

        $response->assertSessionHas('flash_messenger', [
            'message' => 'Doctor has been created',
            'type'    => 'success'
        ]);

        $this->assertEquals(1, Doctor::count());

        $response->assertRedirect(route('doctors.index'));

    }

    /**
     * @test
     * @return void
     */
    public function store_action_with_invalid_params()
    {
        $response = $this->post(route('doctor.save'), []);

        $response->assertSessionHas('errors');
        $response->assertRedirect(route('doctor.create'));
        $response->assertSessionHasErrors([
            'name'      => 'The name field is required.',
            'specialty' => 'The specialty field is required.',
            'registry'  => 'The registry field is required.',
        ]);
    }

    /**
     * @test
     * @return void
     */
    public function edit_action()
    {
        $doctor = $this->createDoctor();

        $response = $this->get(route('doctor.edit', ['doctor' => $doctor->id]));

        $response->assertSuccessful();

        $response->assertSeeText('Edit Doctor');

        $response->assertViewHas('doctor');
    }

    /**
     * @test
     * @return void
     */
    public function update_action_with_valid_params()
    {
        $doctor = $this->createDoctor();

        $doctor->specialty = 'otorhinolaryngologist';

        $response = $this->post(route('doctor.update', $doctor->id), $doctor->toArray());

        $response->assertSessionHas('flash_messenger', [
            'type'    => 'success',
            'message' => 'Doctor has been updated'
        ]);

        $response->assertRedirect(route('doctor.edit', ['doctor' => $doctor->id]));
    }

    /**
     * @test
     * @return void
     */
    public function update_action_with_registry_arealdy_exists()
    {
        $doctor  = $this->createDoctor();
        $doctor2 = $this->createDoctor();

        $data = $doctor->toArray();

        $data['registry'] = $doctor2->registry;

        $response = $this->post(route('doctor.update', $doctor->id), $data);

        $response->assertSessionHasErrors('registry');

        $response->assertRedirect(route('doctor.edit', ['doctor' => $doctor->id]));
    }

    /**
     * @test
     * @return void
     */
    public function appointments_action()
    {
        $doctor  = $this->createDoctor();

        $response = $this->get(route('doctor.appointments', $doctor->id));

        $response->assertViewHas('doctor');

        $response->assertSeeText('Appointment list - ');
    }

    /**
     * @test
     * @return void
     */
    public function delete_action()
    {
        $doctor  = $this->createDoctor();

        $response = $this->get(route('doctor.delete', $doctor->id));

        $response->assertRedirect(route('doctors.index'));
        $response->assertSessionHas('flash_messenger', [
            'type'    => 'success',
            'message' => 'Doctor has been removed'
        ]);

        $this->assertEquals(0, Appointment::where('doctor_id', $doctor->id)->count());

        $this->assertEquals(0, Doctor::count());
    }

    /**
     * @return mixed
     */
    protected function createDoctor()
    {
        return factory(Doctor::class)->create();
    }
}
