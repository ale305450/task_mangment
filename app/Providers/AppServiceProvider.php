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
            \App\Infrastructure\Repositories\CategoryRepository::class
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
