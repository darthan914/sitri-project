<?php


namespace App\Sitri\Actions\Trial;


use App\Sitri\Models\Admin\ParentTrial;

class UpdateTrialAction
{
    /**
     * @param ParentTrial $parentTrial
     * @param array       $data
     *
     * @return bool
     */
    public function execute(ParentTrial $parentTrial, array $data)
    {
        return $parentTrial->update($data);
    }
}
