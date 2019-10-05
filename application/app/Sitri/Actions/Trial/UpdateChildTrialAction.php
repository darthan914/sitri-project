<?php


namespace App\Sitri\Actions\Trial;


use App\Sitri\Models\Admin\ChildTrial;

class UpdateChildTrialAction
{
    /**
     * @param ChildTrial $student
     * @param array      $data
     *
     * @return bool
     */
    public function execute(ChildTrial $student, array $data)
    {
        return $student->update($data);
    }
}
