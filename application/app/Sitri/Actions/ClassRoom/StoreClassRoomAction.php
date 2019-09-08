<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;
use Exception;

class StoreClassRoomAction
{
    /**
     * @param array $request
     *
     * @return ClassRoom
     * @throws Exception
     */
    public function execute(array $request)
    {
        $checkClassRoom = ClassRoom::query()->where('name', $request['name'])->first();

        if(isset($checkClassRoom)){
            throw new Exception('Name already exist');
        }

        $classRoom = new ClassRoom();

        $classRoom->name = $request['name'];
        $classRoom->active = isset($request['active']) ? 1 : 0;

        $classRoom->save();

        return $classRoom;
    }
}
