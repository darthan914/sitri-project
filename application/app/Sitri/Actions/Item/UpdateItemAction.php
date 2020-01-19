<?php


namespace App\Sitri\Actions\Item;


use App\Sitri\Models\Admin\Item;

class UpdateItemAction
{
    /**
     * @param int   $userId
     * @param array $data
     *
     * @return bool
     */
    public function execute($userId, array $data)
    {
        return Item::query()->find($userId)->update($data);
    }
}
