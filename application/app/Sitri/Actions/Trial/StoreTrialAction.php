<?php


namespace App\Sitri\Actions\Trial;


use App\Sitri\Models\Admin\ChildTrial;
use App\Sitri\Models\Admin\ParentTrial;

class StoreTrialAction
{
    /**
     * @param array $data
     *
     * @return bool
     */
    public function execute(array $data)
    {
        $childTrials = [];
        if (is_array($data['child_name']) && is_array($data['class_schedule_id'])) {
            foreach ($data['child_name'] as $key => $childName) {
                if (isset($childName) && isset($data['class_schedule_id'][$key])) {
                    $childTrials[] = new ChildTrial(['name'              => $childName,
                                                     'class_schedule_id' => $data['class_schedule_id'][$key],
                    ]);
                }
            }
        }

        return ParentTrial::query()->create($data)->childTrials()->saveMany($childTrials);
    }
}
