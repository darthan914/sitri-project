<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;

class ActiveClassRoomAction
{
    /**
     * @param int  $classRoomId
     * @param bool $active
     *
     * @return bool
     */
    public function execute($classRoomId, $active)
    {
        return ClassRoom::query()->find($classRoomId)->update(['active' => $active]);
    }
}
