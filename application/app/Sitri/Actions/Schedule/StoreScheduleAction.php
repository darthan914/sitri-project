<?php


namespace App\Sitri\Actions\Schedule;


use App\Sitri\Models\Admin\Schedule;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class StoreScheduleAction
{
    /**
     * @param array $request
     *
     * @return Builder|Model
     */
    public function execute(array $request)
    {
        return Schedule::query()->create($request);
    }
}
