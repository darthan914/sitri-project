<?php


namespace App\Sitri\Actions\Trial;


use App\Sitri\Models\Admin\ChildTrial;
use App\Sitri\Models\Admin\ParentTrial;
use Illuminate\Database\Eloquent\Model;

class StoreChildTrialAction
{
    /**
     * @param ParentTrial $parentTrial
     * @param array       $data
     *
     * @return false|Model
     */
    public function execute(ParentTrial $parentTrial, array $data)
    {
        $childTrial = new ChildTrial([
            'name'              => $data['name'],
            'class_schedule_id' => $data['class_schedule_id'],
            'school'            => $data['school'],
            'age'               => $data['age'],
        ]);

        return $parentTrial->childTrials()->save($childTrial);
    }
}
