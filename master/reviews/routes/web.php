<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'reviews'], function($route) {
			$route->get('/', 'ReviewsResourceController@index')->name('admin.reviews');
			$route->get('/create', 'ReviewsResourceController@create')->name('admin.reviews.create');
			$route->post('/create', 'ReviewsResourceController@store');
			$route->get('/edit/{id}', 'ReviewsResourceController@edit')->name('admin.reviews.edit');
			$route->post('/edit/{id}', 'ReviewsResourceController@update');
			$route->get('delete/{id}', 'ReviewsResourceController@delete')->name('admin.reviews.delete');
		});
	});
});