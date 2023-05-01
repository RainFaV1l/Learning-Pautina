<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Livewire\DashboardController;
use App\Policies\DashboardControllerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        'App\Models\Course' => 'App\Policies\DashboardControllerPolicy',
        'App\Models\Group' => 'App\Policies\DashboardControllerPolicy',
        'App\Models\Lesson' => 'App\Policies\DashboardControllerPolicy',
        'App\Models\CourseCategory' => 'App\Policies\DashboardControllerPolicy',
        'App\Models\User' => 'App\Policies\DashboardControllerPolicy',

//        DashboardController::class => DashboardControllerPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
