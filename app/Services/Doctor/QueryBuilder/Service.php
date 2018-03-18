<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Deletable;
use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Updatable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Service implements Listable, Creatable, Updatable, Deletable
{
    protected $table = 'doctor';

    /**
     * List all doctors
     * @return mixed
     */
    public function all()
    {
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

        DB::table($this->table)->insert(array_merge($data, $timestamps));

        $result = DB::select('SELECT * FROM doctor ORDER BY id DESC LIMIT 1');

        return array_first($result);
    }

    /**
     * Update a doctor
     * @param $doctor
     * @param $data
     * @return bool
     */
    public function update($doctor, $data): bool
    {
        unset($data['_token']);

        $timestamps = ['updated_at' => Carbon::now()];

        return DB::table($this->table)
            ->where('id', (int) $doctor)
            ->update(array_merge($data, $timestamps));
    }

    /**
     * Delete a doctor
     * @param $id
     * @return mixed
     */
    public function delete($id): bool
    {
        DB::table('appointment')
            ->where('doctor_id', (int) $id)
            ->delete();

        return DB::table($this->table)
            ->where('id', (int) $id)
            ->delete();
    }
}
