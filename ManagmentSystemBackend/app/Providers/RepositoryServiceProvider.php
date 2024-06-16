<?php

namespace App\Providers;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Repositories\TaskRepository;
use App\Contracts\RepositoryInterfaces\UserRepositoryInterface;
use App\Contracts\RepositoryInterfaces\TaskRepositoryInterface;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
