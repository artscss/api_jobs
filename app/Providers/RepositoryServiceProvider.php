<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            'App\Http\Interfaces\AuthInterface',
            'App\Http\Repositories\AuthRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\JobInterface',
            'App\Http\Repositories\JobRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\ApplyInterface',
            'App\Http\Repositories\ApplyRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\AuthInterface',
            'App\Http\Repositories\Api\AuthRepository'
        );
        $this->app->bind(
            'App\Http\Interfaces\Api\ApplyInterface',
            'App\Http\Repositories\Api\ApplyRepository'
        );
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
