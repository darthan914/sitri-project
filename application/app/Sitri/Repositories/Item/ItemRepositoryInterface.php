<?php


namespace App\Sitri\Repositories\Item;


interface ItemRepositoryInterface
{
    /**
     * @return array
     */
    public function all();

    /**
     * @param int $id
     *
     * @return array
     */
    public function find($id);

    /**
     * @param string $name
     *
     * @return array
     */
    public function getByName($name);
}
