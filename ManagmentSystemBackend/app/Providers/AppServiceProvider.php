<?php

namespace App\Providers;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Repositories\TaskRepository;
use App\Contracts\RepositoryInterfaces\TaskRepositoryInterface;
use App\Contracts\ServiceInterfaces\AuthServiceInterface;
use App\Contracts\ServiceInterfaces\TaskServiceInterface;
use App\Contracts\Services\AuthService;
use App\Contracts\Services\TaskService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TaskServiceInterface::class, TaskService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
