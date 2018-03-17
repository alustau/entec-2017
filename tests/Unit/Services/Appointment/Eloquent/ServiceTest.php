<?php
namespace Tests\Unit\Services\Appointment\Eloquent;

use App\Contracts\Appointment\Listable;
use App\Models\Appointment;
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
}
