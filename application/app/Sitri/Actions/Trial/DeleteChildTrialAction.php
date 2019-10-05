<?php


namespace App\Sitri\Actions\Trial;


use App\Sitri\Models\Admin\ChildTrial;
use Exception;

class DeleteChildTrialAction
{
    /**
     * @param ChildTrial $childTrial
     *
     * @return bool
     * @throws Exception
     */
    public function execute(ChildTrial $childTrial)
    {
        return $childTrial->delete();
    }
}
