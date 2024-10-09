<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Core\Contracts\CategoryRepositoryInterface::class,
            \App\Infrastructure\Repositories\CategoryRepository::class,
        );

        $this->app->bind(
            \App\Core\Contracts\UserRepositoryInterface::class,
            \App\Infrastructure\Repositories\UserRepository::class
        );

        $this->app->bind(
            \App\Core\Contracts\ProjectRepositoryInterface::class,
            \App\Infrastructure\Repositories\ProjectRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        $this->loadMigrationsFrom(base_path('app/Infrastructure/Persistence/Migrations'));
    }
}
