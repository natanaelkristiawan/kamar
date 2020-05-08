<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'rooms'], function($route) {
			$route->get('/', 'RoomsResourceController@index')->name('admin.rooms');
			$route->get('/create', 'RoomsResourceController@create')->name('admin.rooms.create');
			$route->post('/create', 'RoomsResourceController@store');
			$route->get('/edit/{id}', 'RoomsResourceController@edit')->name('admin.rooms.edit');
			$route->post('/edit/{id}', 'RoomsResourceController@update');
			$route->get('delete/{id}', 'RoomsResourceController@delete')->name('admin.rooms.delete');
		});


		$route->group(['prefix' => 'ameneties'], function($route) {
			$route->get('/', 'AmenetiesResourceController@index')->name('admin.ameneties');
			$route->get('/create', 'AmenetiesResourceController@create')->name('admin.ameneties.create');
			$route->post('/create', 'AmenetiesResourceController@store');
			$route->get('/edit/{id}', 'AmenetiesResourceController@edit')->name('admin.ameneties.edit');
			$route->post('/edit/{id}', 'AmenetiesResourceController@update');
			$route->get('delete/{id}', 'AmenetiesResourceController@delete')->name('admin.ameneties.delete');
		});
	});
});