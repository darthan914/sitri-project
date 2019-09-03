<?php


namespace App\Sitri\Interfaces;


interface DataInterface
{
    /**
     * @return mixed
     */
    public function all();

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function getByRequest(array $data);
}
