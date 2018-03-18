<?php
namespace App\Services\Doctor\QueryBuilder;


use App\Contracts\Doctor\Creatable;
use Carbon\Carbon;

class CreatorService extends ServiceAbstract implements Creatable
{
    /**
     * Create a doctor
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        unset($data['_token']);

        $data = array_merge($data, [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $this->query
            ->from($this->table)
            ->insert($data);

        $result = $this->query
            ->from($this->table)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->get();

        return array_first($result);
    }
}