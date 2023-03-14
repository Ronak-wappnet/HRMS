<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use app\Interfaces\UserInterface;
use app\Repositories\UserRepository;

use app\Repositories\EmployeeRepository;
use app\Interfaces\EmployeeInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(EmployeeInterface::class, EmployeeRepository::class);        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
