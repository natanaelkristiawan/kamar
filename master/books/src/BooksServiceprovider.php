<?php

namespace Master\Books;

use Illuminate\Support\ServiceProvider;

class BooksServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'books');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'books');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.books');

		// Bind facade
		$this->app->bind('master.books', function ($app) {
		return $this->app->make('Master\Books\Books');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Books\Interfaces\BooksRepositoryInterface',
		\Master\Books\Repositories\Eloquent\BooksRepository::class
		);

		$this->app->bind(
		'Master\Books\Interfaces\HistoryRepositoryInterface',
		\Master\Books\Repositories\Eloquent\HistoryRepository::class
		);

		$this->app->register(\Master\Books\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.books'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/books.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/books')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}
