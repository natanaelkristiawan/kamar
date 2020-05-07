<?php

namespace Master\Payments;

use Illuminate\Support\ServiceProvider;

class PaymentsServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'payments');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'payments');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.payments');

		// Bind facade
		$this->app->bind('master.payments', function ($app) {
		return $this->app->make('Master\Payments\Payments');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Payments\Interfaces\PaymentsRepositoryInterface',
		\Master\Payments\Repositories\Eloquent\PaymentsRepository::class
		);

		$this->app->register(\Master\Payments\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.payments'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/payments.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/payments')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}
