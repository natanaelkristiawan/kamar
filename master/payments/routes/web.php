<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'payments'], function($route) {
			$route->get('/', 'PaymentsResourceController@index')->name('admin.payments');
			$route->get('/create', 'PaymentsResourceController@create')->name('admin.payments.create');
			$route->post('/create', 'PaymentsResourceController@store');
			$route->get('/edit/{id}', 'PaymentsResourceController@edit')->name('admin.payments.edit');
			$route->post('/edit/{id}', 'PaymentsResourceController@update');
			$route->get('delete/{id}', 'PaymentsResourceController@delete')->name('admin.payments.delete');
		});
	});
});