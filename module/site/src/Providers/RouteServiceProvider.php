<?php

namespace Module\Site\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Request;
use Route;
use LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Module\Site\Http\Controllers';
	protected $siteNamespace = 'Module\Site\Http\Sites';

	public function boot()
	{
		parent::boot();
		if (Request::is('*/site/edit/*') || Request::is('*/site/delete/*')) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Module\Site\Interfaces\SiteRepositoryInterface');
				return $model->find($id);
			});
		}

		if (Request::is('*/faq/edit/*') || Request::is('*/faq/delete/*')) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Module\Site\Interfaces\FaqRepositoryInterface');
				return $model->find($id);
			});
		}

		if (Request::is('*/faq-categories/edit/*') || Request::is('*/faq-categories/delete/*')) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Module\Site\Interfaces\FaqCategoriesRepositoryInterface');
				return $model->find($id);
			});
		}
	}

	public function map()
	{
		$this->mapWebRoutes();
	}

	protected function mapWebRoutes()
	{
		Route::group([
		'namespace'  => $this->namespace,
		], function ($route) {
			require (__DIR__ . '/../../routes/web.php');
		});

		Route::group([
		'namespace'  => $this->siteNamespace,
		'middleware' => ['web'],
		], function ($route) {
			require (__DIR__ . '/../../routes/midtrans.php');
		});

		Route::group([
			'middleware' => ['web', 'bilingual'],
			'prefix' => LaravelLocalization::setLocale(),
			'namespace'  => $this->siteNamespace,
		], function($route) {
			require (__DIR__ . '/../../routes/site.php');
		});
	}

}
