<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'site'], function($route) {
			$route->get('/', 'SiteResourceController@index')->name('admin.site');
			$route->get('/create', 'SiteResourceController@create')->name('admin.site.create');
			$route->post('/create', 'SiteResourceController@store');
			$route->get('/edit/{id}', 'SiteResourceController@edit')->name('admin.site.edit');
			$route->post('/edit/{id}', 'SiteResourceController@update');
			$route->get('delete/{id}', 'SiteResourceController@delete')->name('admin.site.delete');
		});
	});
});