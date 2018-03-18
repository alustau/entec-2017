<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Listable;

class ListService extends ServiceAbstract implements Listable
{
    /**
     * List all doctors
     * @return mixed
     */
    public function all()
    {
        return $this->query
            ->from($this->table)
            ->get();
    }

    /**
     * List the last doctor inserted
     * @return mixed
     */
    public function last(): array
    {
        $result = $this->query
            ->from($this->table)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        return (array) $result->first();
    }
}
