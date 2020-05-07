<?php

namespace Master\Reviews;

use Illuminate\Support\ServiceProvider;

class ReviewsServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'reviews');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'reviews');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.reviews');

		// Bind facade
		$this->app->bind('master.reviews', function ($app) {
		return $this->app->make('Master\Reviews\Reviews');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Reviews\Interfaces\ReviewsRepositoryInterface',
		\Master\Reviews\Repositories\Eloquent\ReviewsRepository::class
		);

		$this->app->register(\Master\Reviews\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.reviews'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/reviews.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/reviews')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}
