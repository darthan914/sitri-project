<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
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
}
