<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'book-success'], function($route) {
			$route->get('/', 'BookSuccessResourceController@index')->name('admin.bookSuccess');
		});	

		$route->group(['prefix' => 'book-pending'], function($route) {
			$route->get('/', 'BookPendingResourceController@index')->name('admin.bookPending');
			$route->get('cancel-booking/{order_id}', 'BookPendingResourceController@cancelBooking')->name('admin.bookPending.cancel');
		});
	});
});