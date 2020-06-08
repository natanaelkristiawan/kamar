<?php

namespace Master\Reviews\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Request;
use Route;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Master\Reviews\Http\Controllers';

	public function boot()
	{
		parent::boot();
		if (Request::is('*/reviews/confirm/*') || Request::is('*/reviews/delete/*') || Request::is('*/reviews/decline/*') ) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Master\Reviews\Interfaces\ReviewsRepositoryInterface');
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
	}

}
