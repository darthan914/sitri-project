<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;
use Exception;

class DeleteClassRoomAction
{
    /**
     * @param ClassRoom $classRoom
     *
     * @return bool
     * @throws Exception
     */
    public function execute(ClassRoom $classRoom)
    {
        $classRoom->delete();

        return true;
    }
}
