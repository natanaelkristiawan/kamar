<?php

namespace Master\Rooms;

use Illuminate\Support\ServiceProvider;

class RoomsServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'rooms');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'rooms');

		// Call pblish redources function
		$this->publishResources();

	}

	/**
	* Register the service provider.
	*
	* @return void
	*/
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.rooms');

		// Bind facade
		$this->app->bind('master.rooms', function ($app) {
		return $this->app->make('Master\Rooms\Rooms');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Rooms\Interfaces\RoomsRepositoryInterface',
		\Master\Rooms\Repositories\Eloquent\RoomsRepository::class
		);

		$this->app->register(\Master\Rooms\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.rooms'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/rooms.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/rooms')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}
