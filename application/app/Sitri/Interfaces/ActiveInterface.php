<?php


namespace App\Sitri\Interfaces;


interface ActiveInterface
{
    /**
     * @param bool $active
     *
     * @return mixed
     */
    public function getIsActive($active);
}
