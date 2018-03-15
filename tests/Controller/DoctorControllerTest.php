<?php

namespace Tests\Controller;

use App\Doctor;
use Tests\TestCase;
use \Mockery;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DoctorControllerTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * @test
     * @return void
     */
    public function index_action()
    {
        $response = $this->get(route('doctors.index'));

        $response->assertStatus(200);

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

        $response->assertStatus(200);

        $response->assertSeeText('Doctor Form');
    }
}
