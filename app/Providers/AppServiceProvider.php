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
            'App\Storage\InterfaceRepository',
            'App\Storage\EloquentRepository'
        );

        //Register the site registrar to user repository
        $this->app->bind(
            'App\Storage\User\Registrar\InterfaceRegistrar', function($app)
            {
                return new \App\Storage\User\Registrar\SiteRegistrar(
                    $this->app->make('App\Storage\User\EloquentUserRepository')
                );
            }
        );
        $this->app->bind(
            'App\Storage\User\InterfaceUser',
            'App\Storage\User\EloquentUserRepository'
        );

    }
}
