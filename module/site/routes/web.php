<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->group(['prefix' => 'site'], function($route) {
			$route->get('/', 'SiteResourceController@index')->name('admin.site');
			$route->post('/', 'SiteResourceController@store');
		});

    $route->group(['prefix' => 'faq-categories'], function($route) {
      $route->get('/', 'FaqCategoriesResourceController@index')->name('admin.faqcategories');
      $route->get('/create', 'FaqCategoriesResourceController@create')->name('admin.faqcategories.create');
      $route->post('/create', 'FaqCategoriesResourceController@store');
      $route->get('/edit/{id}', 'FaqCategoriesResourceController@edit')->name('admin.faqcategories.edit');
      $route->post('/edit/{id}', 'FaqCategoriesResourceController@update');
      $route->get('delete/{id}', 'FaqCategoriesResourceController@delete')->name('admin.faqcategories.delete');
    });  

    $route->group(['prefix' => 'faq'], function($route) {
      $route->get('/', 'FaqResourceController@index')->name('admin.faq');
      $route->get('/create', 'FaqResourceController@create')->name('admin.faq.create');
      $route->post('/create', 'FaqResourceController@store');
      $route->get('/edit/{id}', 'FaqResourceController@edit')->name('admin.faq.edit');
      $route->post('/edit/{id}', 'FaqResourceController@update');
      $route->get('delete/{id}', 'FaqResourceController@delete')->name('admin.faq.delete');
    }); 
	});
});