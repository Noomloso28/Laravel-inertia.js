<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //admin access every page.
        Gate::before(function ($user, $ability) {

            Log::info('gate before working');

            return $user->hasRole('administrator') ? true : null;
//            return $user->hasRole('administrator' , 'web' ) ? true : null;
//            if ($user->isAdministrator()) {
//                return true; // Grant access to all abilities for admin users
//            }
//            return auth('web')->user()->hasRole('administrator') ? true : null;
        });

    }
}
