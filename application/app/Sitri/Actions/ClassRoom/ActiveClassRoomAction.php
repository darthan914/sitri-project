<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;

class ActiveClassRoomAction
{
    /**
     * @param ClassRoom $classRoom
     * @param           $active
     *
     * @return bool
     */
    public function execute(ClassRoom $classRoom, $active)
    {
        return $classRoom->update(['active' => $active]);
    }
}
