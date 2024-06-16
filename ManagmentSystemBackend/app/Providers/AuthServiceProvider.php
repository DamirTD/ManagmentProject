<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Contracts\ServiceInterfaces\AuthServiceInterface;
use App\Contracts\Services\AuthService;
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
    ];

    public function register(): void
    {
        $this->app->singleton(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
