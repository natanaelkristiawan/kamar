<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'payments'], function($route) {
			$route->get('/', 'PaymentsResourceController@index')->name('admin.payments');
		});
	});
});