<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Facility;
use App\Models\Schedule;
use App\Models\User;
use App\Policies\FacilityPolicy;
use App\Policies\SchedulePolicy;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Facility::class => FacilityPolicy::class,
        Schedule::class => SchedulePolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });
    
        Gate::define('isUser', function($user) {
            return $user->role == 'user';
        });
    }
}
