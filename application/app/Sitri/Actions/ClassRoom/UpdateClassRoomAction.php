<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;

class UpdateClassRoomAction
{
    /**
     * @param ClassRoom $classRoom
     * @param array     $request
     *
     * @return ClassRoom
     */
    public function execute(ClassRoom $classRoom, array $request)
    {
        $classRoom->name = $request['name'];
        $classRoom->active = isset($request['active']) ? 1 : 0;

        $classRoom->save();

        return $classRoom;
    }
}
