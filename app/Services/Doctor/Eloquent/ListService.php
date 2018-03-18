<?php
namespace App\Services\Doctor\Eloquent;


use App\Contracts\Doctor\Listable;

class ListService extends ServiceAbstract implements Listable
{

    /**
     * List all doctors
     * @return mixed
     */
    public function all()
    {
        return $this->doctor->all();
    }
}