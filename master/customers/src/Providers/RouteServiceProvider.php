<?php

namespace Master\Customers\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Request;
use Route;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Master\Customers\Http\Controllers';

	public function boot()
	{
		parent::boot();
		if (Request::is('*/customers/edit/*') || Request::is('*/customers/delete/*')) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Master\Customers\Interfaces\CustomersRepositoryInterface');
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
