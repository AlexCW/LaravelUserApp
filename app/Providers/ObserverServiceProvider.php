<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Storage\User\User;

class ObserverServiceProvider extends ServiceProvider {

	/**
	 * Bootstraps
	 */
	public function boot() {
		User::observe( new \App\Observers\Validation\UserValidationObserver(\App::make('validator')) );
	}

 	/**
     * Register any application services.
     *
     * @return void
     */
	public function register() { }
}