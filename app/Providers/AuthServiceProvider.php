<?php

namespace App\Providers;

use App\Auth\VpnAuthGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Vpn auth Guard
        Auth::extend('vpnauth', function ($app, $name, array $config) {
            $api = $this->app->make('App\Auth\VpnAuthGuard');
            $api->setName('vpnauth');
            Log::info('VPNAuth created');
            return $api;

            //return new JwtGuard(Auth::createUserProvider($config['provider']));
        });

        // Is admin Gate
        Gate::define('is-admin', function ($user) {
            return $user->getIsAdmin();
        });

        // Is user Gate
        Gate::define('is-user', function ($user) {
            return !empty($user);
        });
    }
}
