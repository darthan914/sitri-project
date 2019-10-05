<?php


namespace App\Sitri\Repositories\Trial;


interface TrialRepositoryInterface
{
    public function all();

    public function getByRequest(array $data);
}
