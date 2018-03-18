<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Creatable;
use App\Contracts\Doctor\Deletable;
use App\Contracts\Doctor\Listable;
use App\Contracts\Doctor\Updatable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Service implements Updatable, Deletable
{
    protected $table = 'doctor';

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
