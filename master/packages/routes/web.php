<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'packages'], function($route) {
			$route->get('/', 'PackagesResourceController@index')->name('admin.packages');
			$route->get('/create', 'PackagesResourceController@create')->name('admin.packages.create');
			$route->post('/create', 'PackagesResourceController@store');
			$route->get('/edit/{id}', 'PackagesResourceController@edit')->name('admin.packages.edit');
			$route->post('/edit/{id}', 'PackagesResourceController@update');
			$route->get('delete/{id}', 'PackagesResourceController@delete')->name('admin.packages.delete');
		});
	});
});