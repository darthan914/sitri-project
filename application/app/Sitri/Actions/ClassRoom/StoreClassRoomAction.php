<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;

class StoreClassRoomAction
{
    /**
     * @param array $request
     *
     * @return ClassRoom
     */
    public function execute(array $request)
    {
        $classRoom = new ClassRoom();

        $classRoom->name = $request['name'];
        $classRoom->active = isset($request['active']) ? 1 : 0;

        $classRoom->save();

        return $classRoom;
    }
}
