<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;
use Exception;

class UpdateClassRoomAction
{
    /**
     * @param int   $classRoomId
     * @param array $request
     *
     * @return bool
     * @throws Exception
     */
    public function execute($classRoomId, array $request)
    {
        $check = ClassRoom::query()->where('name', $request['name'])
                          ->where('id', '<>', $classRoomId)
                          ->first()
        ;

        if (isset($check)) {
            throw new Exception('Name already exist');
        }

        return ClassRoom::query()->find($classRoomId)->update($request);
    }
}
