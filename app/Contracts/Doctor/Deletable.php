<?php
/**
 * Created by PhpStorm.
 * User: alustau
 * Date: 16/03/18
 * Time: 20:56
 */

namespace App\Contracts\Doctor;


/**
 * Interface Deletable
 * @package App\Contracts\Doctor
 */
interface Deletable
{
    /**
     * Delete a doctor
     * @param $id
     * @return mixed
     */
    public function delete($id): bool;
}