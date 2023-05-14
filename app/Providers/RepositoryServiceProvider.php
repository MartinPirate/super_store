<?php

namespace App\Providers;

use App\Interfaces\SupermarketRepositoryInterface;
use App\Repository\SupermarketRepository;
use App\Services\SupermarketService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SupermarketRepositoryInterface::class, SupermarketRepository::class);
        $this->app->bind(SupermarketService::class, function ($app) {
            return new SupermarketService($app->make(SupermarketRepository::class));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
