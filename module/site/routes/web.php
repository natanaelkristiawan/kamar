<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'site'], function($route) {
			$route->get('/', 'SiteResourceController@index')->name('admin.site');
			$route->post('/', 'SiteResourceController@store');
		});
	});
});