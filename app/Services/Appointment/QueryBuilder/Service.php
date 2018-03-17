<?php
namespace App\Services\Appointment\QueryBuilder;


use App\Contracts\Appointment\Creatable;
use App\Contracts\Appointment\Listable;
use App\Contracts\Appointment\Deletable;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Service implements Listable, Creatable, Deletable
{
    protected $table = 'appointment';

    /**
     * Create a Appointment
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

        $select = "SELECT a.*, d.name as doctor_name, d.specialty as doctor_specialty FROM appointment as a inner join doctor as d on a.doctor_id = d.id ORDER BY id DESC LIMIT 1";
        $result = DB::select($select);

        return array_first($result);
    }

    /**
     * Delete a Appointment
     * @param $id
     * @return mixed
     */
    public function delete($id): bool
    {
        return DB::table($this->table)->where('id', $id)->delete();
    }

    /**
     * List all appointments
     * @return mixed
     */
    public function all()
    {
        return DB::table($this->table)
            ->join('doctor as d', 'appointment.doctor_id', '=', 'd.id')
            ->select('appointment.*', 'd.name as doctor_name', 'd.specialty as doctor_specialty')
            ->get();
    }
}
