<?php

namespace Tests\Controller;

use App\Doctor;
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
        $data = factory(Doctor::class)->make()->toArray();

        $response = $this->post(route('doctor.save'), $data);

        $response->assertSessionHas('flash_messenger', [
            'message' => 'Doctor has been created',
            'type'    => 'success'
        ]);

        $this->assertEquals(1, Doctor::count());

        $response->assertRedirect(route('doctors.index'));

    }
}
