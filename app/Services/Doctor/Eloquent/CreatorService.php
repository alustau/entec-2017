<?php
namespace App\Services\Doctor\Eloquent;


use App\Contracts\Doctor\Creatable;

class CreatorService extends ServiceAbstract implements Creatable
{
    /**
     * Create a doctor
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->doctor->create($data);
    }
}