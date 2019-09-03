<?php

namespace App\Providers;

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

        $this->app->singleton(UserRepositoryInterface::class,UserRepository::class);
        $this->app->singleton(StudentRepositoryInterface::class,StudentRepository::class);
    }
}
