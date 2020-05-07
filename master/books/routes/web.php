<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'books'], function($route) {
			$route->get('/', 'BooksResourceController@index')->name('admin.books');
			$route->get('/create', 'BooksResourceController@create')->name('admin.books.create');
			$route->post('/create', 'BooksResourceController@store');
			$route->get('/edit/{id}', 'BooksResourceController@edit')->name('admin.books.edit');
			$route->post('/edit/{id}', 'BooksResourceController@update');
			$route->get('delete/{id}', 'BooksResourceController@delete')->name('admin.books.delete');
		});
	});
});