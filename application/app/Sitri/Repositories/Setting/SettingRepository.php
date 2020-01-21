<?php


namespace App\Sitri\Repositories\Setting;


use App\Sitri\Models\Admin\Setting;

class SettingRepository implements SettingRepositoryInterface
{

    /**
     * @return array
     */
    public function getCost()
    {
        return json_decode(Setting::query()->find('cost')->value, true);
    }
}
