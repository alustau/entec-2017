<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Listable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Service implements Listable, Creatable
{

    /**
     * List all doctors
     * @return mixed
     */
    public function all()
    {
        return DB::table('doctor')->get();
    }

    /**
     * Create a doctor
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        unset($data['_token']);

        $timestamps = [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        DB::table('doctor')->insert(array_merge($data, $timestamps));

        $result = DB::select('SELECT * FROM doctor ORDER BY id DESC LIMIT 1');

        return array_first($result);
    }
}
