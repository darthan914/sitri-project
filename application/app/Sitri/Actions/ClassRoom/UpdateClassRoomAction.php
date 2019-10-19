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
     * @return bool
     * @throws Exception
     */
    public function execute(ClassRoom $classRoom, array $request)
    {
        $check = ClassRoom::query()->where('name', $request['name'])
                                   ->where('id', '<>', $classRoom->id)
                                   ->first()
        ;

        if (isset($check)) {
            throw new Exception('Name already exist');
        }

        $request['active'] = isset($request['active']) ? 1 : 0;

        return $classRoom->update($request);
    }
}
