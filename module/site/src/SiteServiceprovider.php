<?php

namespace Module\Site;

use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'site');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'site');

		// Call pblish redources function
		$this->publishResources();


		$validator = app()->make(\Illuminate\Validation\Factory::class);
    $validator->extend('captcha', function ($attribute, $value, $parameters, $validator) {
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='.env('RECAPTCHA_SITE_SECRET').'&response='.$value;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    $result=curl_exec($ch);
    curl_close($ch);
    $hasil = json_decode($result);



    if (!$hasil->success) {
        return false;
    } else {
        return true;
    }
    });

    $validator->replacer('captcha', function ($message, $attribute, $rule, $parameters) {
        return 'Captcha error';
    });


	}

	/**
	* Register the service provider.
	*
	* @return void
	*/
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'module.site');

		// Bind facade
		$this->app->bind('module.site', function ($app) {
		return $this->app->make('Module\Site\Site');
		});   

		// Bind article to repository
		$this->app->bind(
		'Module\Site\Interfaces\SiteRepositoryInterface',
		\Module\Site\Repositories\Eloquent\SiteRepository::class
		);

		$this->app->bind(
		'Module\Site\Interfaces\FaqRepositoryInterface',
		\Module\Site\Repositories\Eloquent\FaqRepository::class
		);

		$this->app->bind(
		'Module\Site\Interfaces\FaqCategoriesRepositoryInterface',
		\Module\Site\Repositories\Eloquent\FaqCategoriesRepository::class
		);

		$this->app->bind(
		'Module\Site\Interfaces\BookmarkRepositoryInterface',
		\Module\Site\Repositories\Eloquent\BookmarkRepository::class
		);

		$this->app->register(\Module\Site\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['module.site'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/site.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/site')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}
