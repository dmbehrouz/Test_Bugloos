<?php

namespace App\Providers;

use App\Http\Services\LogServices;
use App\Interfaces\LogServiceRepositoryInterface;
use App\Repositories\LogServiceRepository;
use Illuminate\Support\ServiceProvider;

class LogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repo = new LogServiceRepository();
        $this->app->bind('log_service', function () use ($repo) {
            return new LogServices($repo);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
