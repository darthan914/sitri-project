<?php


namespace App\Sitri\Actions\Trial;


use App\Sitri\Models\Admin\ParentTrial;
use Exception;

class DeleteTrialAction
{
    /**
     * @param ParentTrial $parentTrial
     *
     * @return bool
     * @throws Exception
     */
    public function execute(ParentTrial $parentTrial)
    {
        return $parentTrial->delete();
    }
}
