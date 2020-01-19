<?php


namespace App\Sitri\Actions\Item;



use App\Sitri\Models\Admin\Item;

class DeleteItemAction
{
    /**
     * @param int $itemId
     *
     * @return bool
     */
    public function execute($itemId)
    {
        return Item::query()->where('id', $itemId)->delete();
    }
}
