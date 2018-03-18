<?php
namespace App\Services\Doctor\Eloquent;


use App\Models\Doctor;

/**
 * Class ServiceAbstract
 * @package App\Services\Doctor\Eloquent
 */
abstract class ServiceAbstract
{
    /**
     * @var Doctor
     */
    protected $doctor;

    /**
     * ServiceAbstract constructor.
     * @param Doctor $doctor
     */
    public function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }
}
