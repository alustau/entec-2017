<?php
namespace App\Services\Appointment\Eloquent;


use App\Contracts\Appointment\Creatable;
use App\Contracts\Appointment\Listable;
use App\Contracts\Appointment\Deletable;
use App\Models\Appointment;

class Service implements Listable, Creatable, Deletable
{
    protected $appointment;

    public function __construct(Appointment $appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * List all appointments
     * @return mixed
     */
    public function all()
    {
        return $this->appointment->all();
    }

    /**
     * Create a Appointment
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->appointment->create($data);
    }

    /**
     * Delete a doctor
     * @param $id
     * @return mixed
     */
    public function delete($appointment): bool
    {
        if (! $appointment instanceof Appointment) {
            $appointment = Appointment::find($appointment);
        }

        return $appointment->delete();
    }
}
