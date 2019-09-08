<?php


namespace App\Sitri\Actions\ClassRoom;


use App\Sitri\Models\Admin\ClassRoom;

class ActiveClassRoomAction
{
    /**
     * @param ClassRoom $classRoom
     * @param          $active
     *
     * @return ClassRoom
     */
    public function execute(ClassRoom $classRoom, $active)
    {
        $classRoom->active = $active;
        $classRoom->save();

        return $classRoom;
    }
}
