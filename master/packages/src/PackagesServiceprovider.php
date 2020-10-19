<?php

namespace Master\Packages;

use Illuminate\Support\ServiceProvider;

class PackagesServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'packages');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'packages');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.packages');

		// Bind facade
		$this->app->bind('master.packages', function ($app) {
		return $this->app->make('Master\Packages\Packages');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Packages\Interfaces\PackagesRepositoryInterface',
		\Master\Packages\Repositories\Eloquent\PackagesRepository::class
		);


		$this->app->bind(
		'Master\Packages\Interfaces\CounterRepositoryInterface',
		\Master\Packages\Repositories\Eloquent\CounterRepository::class
		);

		$this->app->register(\Master\Packages\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.packages'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/packages.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/packages')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}
