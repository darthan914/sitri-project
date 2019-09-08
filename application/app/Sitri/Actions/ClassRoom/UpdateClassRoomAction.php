<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;
use Exception;

class UpdateClassRoomAction
{
    /**
     * @param ClassRoom $classRoom
     * @param array     $request
     *
     * @return ClassRoom
     * @throws Exception
     */
    public function execute(ClassRoom $classRoom, array $request)
    {
        $checkClassRoom = ClassRoom::query()->where('name', $request['name'])
                                   ->where('id', '<>', $classRoom->id)
                                   ->first()
        ;

        if (isset($checkClassRoom)) {
            throw new Exception('Name already exist');
        }

        $classRoom->name = $request['name'];
        $classRoom->active = isset($request['active']) ? 1 : 0;

        $classRoom->save();

        return $classRoom;
    }
}
