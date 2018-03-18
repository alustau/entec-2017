<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Appointment\Deletable as AppointmentDeletable;
use App\Contracts\Doctor\Deletable;
use Illuminate\Database\Query\Builder as QueryBuilder;

class DeleterService extends ServiceAbstract implements Deletable
{
    protected $appointment;

    public function __construct(QueryBuilder $query, AppointmentDeletable $service)
    {
        parent::__construct($query);

        $this->appointment = $service;
    }

    /**
     * Delete a doctor
     * @param $id
     * @return mixed
     */
    public function delete($id): bool
    {
        $this->appointment->deleteAll($id);

        return $this->query->from($this->table)
            ->where('id', (int) $id)
            ->delete();
    }
}
