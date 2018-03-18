<?php
namespace Tests\Unit\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\Doctor\Eloquent\ListService;
use App\Services\Doctor\Eloquent\CreatorService;
use App\Services\Doctor\Eloquent\Service;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Doctor\CommumTests;
use Tests\Unit\Services\Helper;

class ServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumTests, CommumAsserts;

    protected $service;


    public function setUp()
    {
        parent::setUp();

        $this->doctor = new Doctor();

        $this->service = new Service($this->doctor);
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
    public function it_delete_a_doctor()
    {
        $doctor = factory(Appointment::class)->create()->doctor;

        $deleted = $this->service->delete($doctor->id);

        $this->assertTrue($deleted);

        $this->assertEquals(0, Appointment::where('doctor_id', $doctor->id)->count());

        $this->assertEmpty($this->doctor->find($doctor->id));
    }
}
