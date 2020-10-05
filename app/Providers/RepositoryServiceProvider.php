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
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\UserRepositoryInterface::class, \App\Repositories\UserRepositoryInterfaceEloquent::class);
        $this->app->bind(\App\Repositories\RoleRepositoryInterface::class, \App\Repositories\RoleRepositoryEloquent::class);
        //:end-bindings:
    }
}
