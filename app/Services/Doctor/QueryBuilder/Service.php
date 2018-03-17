<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Listable;
use Illuminate\Support\Facades\DB;

class Service implements Listable
{

    /**
     * List all doctors
     * @return mixed
     */
    public function all()
    {
        return DB::table('doctor')->get();
    }
}
