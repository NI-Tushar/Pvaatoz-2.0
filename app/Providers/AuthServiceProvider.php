<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

        Gate::define('isAdmin', function ($admin) {
            return $admin->role == 'Admin';
        });
        Gate::define('isEditor', function ($admin) {
            return $admin->role == 'Editor';
        });
        Gate::define('isModerator', function ($admin) {
            return $admin->role == 'Moderator';
        });

    }

    /**
     * Get the model to be used by the gate.
     *
     * @return string
     */
    protected function gateModel()
    {
        return Admin::class;
    }
}
