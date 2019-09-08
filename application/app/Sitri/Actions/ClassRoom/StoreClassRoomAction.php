<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreClassRoomAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     * @throws Exception
     */
    public function execute(array $request)
    {
        $check = ClassRoom::query()->where('name', $request['name'])->first();

        if(isset($check)){
            throw new Exception('Name already exist');
        }

        return ClassRoom::query()->create($request);
    }
}
