<?php


namespace App\Sitri\Actions\Item;



use App\Sitri\Models\Admin\Item;

class StoreItemAction
{
    /**
     * @param array $request
     *
     * @return array
     */
    public function execute(array $request)
    {
        return Item::query()->create($request)->toArray();
    }
}
