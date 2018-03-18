<?php
namespace App\Services\Doctor\QueryBuilder;

use App\Contracts\Doctor\Updatable;
use Carbon\Carbon;

class UpdaterService extends ServiceAbstract implements Updatable
{
    /**
     * Update a doctor
     * @param $doctor
     * @param $data
     * @return bool
     */
    public function update($doctor, $data): bool
    {
        unset($data['_token']);

        $data = array_merge($data, ['updated_at' => Carbon::now()]);

        return $this->query
            ->from($this->table)
            ->where('id', (int) $doctor)
            ->update($data);
    }
}
