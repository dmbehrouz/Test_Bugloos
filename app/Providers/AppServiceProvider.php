<?php

namespace App\Providers;

use App\Interfaces\LogServiceRepositoryInterface;
use App\Repositories\LogServiceRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LogServiceRepositoryInterface::class, LogServiceRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
