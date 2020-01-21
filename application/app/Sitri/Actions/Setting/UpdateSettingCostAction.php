<?php


namespace App\Sitri\Actions\Setting;


use App\Sitri\Models\Admin\Setting;
use Illuminate\Database\Eloquent\Model;

class UpdateSettingCostAction
{
    /**
     * @param array $data
     *
     * @return Model
     */
    public function execute(array $data)
    {
        return Setting::query()->updateOrCreate(['key' => 'cost'], ['value' => json_encode($data)]);
    }
}
