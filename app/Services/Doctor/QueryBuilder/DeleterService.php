<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Deletable;

class DeleterService extends ServiceAbstract implements Deletable
{
    /**
     * Delete a doctor
     * @param $id
     * @return mixed
     */
    public function delete($id): bool
    {
        $query = clone $this->query;

        $query->from('appointment')
            ->where('doctor_id', (int) $id)
            ->delete();

        return $this->query->from($this->table)
            ->where('id', (int) $id)
            ->delete();
    }
}
