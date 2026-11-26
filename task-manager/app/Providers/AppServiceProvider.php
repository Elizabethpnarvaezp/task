<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\TaskRepositoryInterface;
use App\Repositories\SessionTaskRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            TaskRepositoryInterface::class,
            SessionTaskRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}