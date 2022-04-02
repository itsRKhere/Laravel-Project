<?php

namespace App\Providers;

use Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // 'App\Models\user' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        

        Gate::define('isAdmin', function ($user) {
            if ($user->roles->first()->Role_name === 'Admin') {
                return true;
            }
        });

        Gate::define('isManager', function ($user) {
            if ($user->roles->first()->Role_name === 'Manager') {
                return true;
            }
        });

        Gate::define('isDev', function ($user) {
            if ($user->roles->first()->Role_name === 'Dev') {
                return true;
            }
        });

        //
    }
}
