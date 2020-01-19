<?php


namespace App\Sitri\Repositories\Item;


use App\Sitri\Models\Admin\Item;

class ItemRepository implements ItemRepositoryInterface
{


    public function all()
    {
        return Item::query()->orderBy('name')->get()->toArray();
    }

    public function find($id)
    {
        return Item::query()->find($id)->toArray();
    }

    public function getByName($name)
    {
        return Item::query()->where('name', $name)->first()->toArray();
    }
}
