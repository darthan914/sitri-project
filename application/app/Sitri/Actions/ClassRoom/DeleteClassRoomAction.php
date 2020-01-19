<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;
use Exception;

class DeleteClassRoomAction
{
    /**
     * @param int $classRoomId
     *
     * @return bool
     * @throws Exception
     */
    public function execute($classRoomId)
    {
        return ClassRoom::query()->find($classRoomId)->delete();
    }
}
