<?php

namespace App\Providers;

use App\Sitri\Repositories\Absence\AbsenceRepository;
use App\Sitri\Repositories\Absence\AbsenceRepositoryInterface;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepository;
use App\Sitri\Repositories\ClassRoom\ClassRoomRepositoryInterface;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepository;
use App\Sitri\Repositories\ClassSchedule\ClassScheduleRepositoryInterface;
use App\Sitri\Repositories\ClassStudent\ClassStudentRepository;
use App\Sitri\Repositories\ClassStudent\ClassStudentRepositoryInterface;
use App\Sitri\Repositories\Item\ItemRepository;
use App\Sitri\Repositories\Item\ItemRepositoryInterface;
use App\Sitri\Repositories\Payment\PaymentRepository;
use App\Sitri\Repositories\Payment\PaymentRepositoryInterface;
use App\Sitri\Repositories\Reschedule\RescheduleRepository;
use App\Sitri\Repositories\Reschedule\RescheduleRepositoryInterface;
use App\Sitri\Repositories\Schedule\ScheduleRepository;
use App\Sitri\Repositories\Schedule\ScheduleRepositoryInterface;
use App\Sitri\Repositories\Setting\SettingRepository;
use App\Sitri\Repositories\Setting\SettingRepositoryInterface;
use App\Sitri\Repositories\Student\StudentRepository;
use App\Sitri\Repositories\Student\StudentRepositoryInterface;
use App\Sitri\Repositories\User\UserRepository;
use App\Sitri\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->singleton(ScheduleRepositoryInterface::class, ScheduleRepository::class);
        $this->app->singleton(ClassRoomRepositoryInterface::class, ClassRoomRepository::class);
        $this->app->singleton(ClassScheduleRepositoryInterface::class, ClassScheduleRepository::class);
        $this->app->singleton(ClassStudentRepositoryInterface::class, ClassStudentRepository::class);
        $this->app->singleton(RescheduleRepositoryInterface::class, RescheduleRepository::class);
        $this->app->singleton(AbsenceRepositoryInterface::class, AbsenceRepository::class);
        $this->app->singleton(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->singleton(ItemRepositoryInterface::class, ItemRepository::class);
        $this->app->singleton(SettingRepositoryInterface::class, SettingRepository::class);

    }
}
