<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\UpdateSettingCostRequest;
use App\Sitri\Actions\Setting\UpdateSettingCostAction;
use App\Sitri\Repositories\Setting\SettingRepositoryInterface;

class SettingController extends Controller
{
    /**
     * @var SettingRepositoryInterface
     */
    private $settingRepository;

    /**
     * SettingController constructor.
     *
     * @param SettingRepositoryInterface $settingRepository
     */
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function cost()
    {
        $cost = $this->settingRepository->getCost();

        return view('admin.setting.cost', compact('cost'));
    }

    public function updateCost(UpdateSettingCostRequest $request, UpdateSettingCostAction $action)
    {
        $request->validate();

        $action->execute($request->all());

        return redirect()->back()->with('success', 'Data has been updated!');
    }
}
