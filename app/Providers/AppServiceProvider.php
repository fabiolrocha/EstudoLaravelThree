<?php

namespace App\Providers;

use App\Models\Client;
use App\Models\Project;
use App\Policies\ProjectPolicy;
use Illuminate\Support\ServiceProvider;
use App\Models\Task;
use App\Models\User;
use App\Policies\TaskPolicy;
use App\Policies\CLientPolicy;
use App\Policies\UserPolicy;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
        Client::class => CLientPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
