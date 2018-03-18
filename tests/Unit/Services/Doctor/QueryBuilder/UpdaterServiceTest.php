<?php

namespace Tests\Unit\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Updatable;
use App\Models\Doctor;
use App\Services\Doctor\QueryBuilder\UpdaterService;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Unit\Services\Doctor\CommumAsserts;
use Tests\Unit\Services\Helper;

class UpdaterServiceTest extends TestCase
{
    use DatabaseTransactions, Helper, CommumAsserts;

    protected $service;

    protected $query;

    protected $list;

    public function setUp()
    {
        parent::setUp();

        $query = DB::getFacadeRoot()->query();

        $this->service = new UpdaterService($query);
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

        $this->assertEquals('Denis Alustau', Doctor::find($doctor->id)->name);
    }
}
