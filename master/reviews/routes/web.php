<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'reviews'], function($route) {
			$route->get('/', 'ReviewsResourceController@index')->name('admin.reviews');
			$route->get('/confirm/{id}', 'ReviewsResourceController@confirm')->name('admin.reviews.confirm');
			$route->get('/decline/{id}', 'ReviewsResourceController@decline')->name('admin.reviews.decline');
			$route->get('delete/{id}', 'ReviewsResourceController@delete')->name('admin.reviews.delete');
		});
	});
});