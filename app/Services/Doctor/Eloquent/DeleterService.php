<?php
namespace App\Services\Doctor\Eloquent;

use App\Contracts\Doctor\Deletable;

class DeleterService extends ServiceAbstract implements Deletable
{

    /**
     * Delete a doctor and its appointments
     * @param $id
     * @return mixed
     */
    public function delete($id): bool
    {
        $doctor = $this->find($id);

        $doctor->appointments()->delete();

        return $doctor->delete();
    }
}
