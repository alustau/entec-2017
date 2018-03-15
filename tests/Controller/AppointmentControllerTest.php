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
}
