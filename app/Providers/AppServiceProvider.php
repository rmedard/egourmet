<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\DishesContract',
            'App\Repositories\DishesRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\RestosContract',
            'App\Repositories\RestosRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\UsersContract',
            'App\Repositories\UsersRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\CuisinesContract',
            'App\Repositories\CuisinesRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\AddressesContract',
            'App\Repositories\AddressesRepository'
        );
    }
}
