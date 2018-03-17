<?php
namespace Tests\Unit\Services\Doctor;


use App\Models\Doctor;

trait Helper
{
    public function createDoctor($quantity = 3)
    {
        return factory(Doctor::class, $quantity)->create();
    }
}
