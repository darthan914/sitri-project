<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (config('darthan.accesses') as $list) {
            foreach ($list['data'] as $list2) {
                if (isset($list2['policy'])) {
                    Gate::define($list2['value'] . '-' . $list['id'], $list2['policy']);
                    continue;
                }

                Gate::define($list2['value'] . '-' . $list['id'], function ($user) use ($list, $list2) {
                    return $user->hasAccess($list2['value'] . '-' . $list['id']);
                });
            }
        }
    }
}
