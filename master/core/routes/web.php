<?php

$route->group(['prefix' => env('ADMIN_URL', 'admin')], function ($route) {
	$route->group(['middleware' => ['admin']], function ($route) {
		$route->get('/', 'DashboardResourceController@index');
		$route->get('dashboard', 'DashboardResourceController@index')->name('admin.dashboard');
    $route->get('profile', 'DashboardResourceController@profile')->name('admin.profile');
    $route->post('profile', 'DashboardResourceController@doUpdateProfile');
    $route->post('update-profile-picture', 'DashboardResourceController@updateProfilePicture')->name('admin.update-profile-picture');

		// login
		$route->get('login', 'CoreResourceController@login')->name('admin.login');
		$route->post('login', 'CoreResourceController@doLogin');


		// logout
		$route->get('logout', 'CoreResourceController@logout')->name('admin.logout');


	});
});