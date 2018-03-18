<?php
namespace Tests\Unit\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Updatable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\Eloquent\UpdaterService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Helper;

class UpdaterServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumAsserts;

    protected $service;


    public function setUp()
    {
        parent::setUp();

        $this->doctor = new Doctor();

        $this->service = new UpdaterService($this->doctor);
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
}
