<?php 
$route->get('/', 'PublicController@index')->name('public.index');
$route->get(LaravelLocalization::transRoute('routes.roomDetail'), 'PublicController@detailRoom')->name('public.roomDetail');
$route->get(LaravelLocalization::transRoute('routes.rooms'), 'PublicController@rooms')->name('public.rooms');
$route->get('blogs', 'PublicController@blogs')->name('public.blogs');
$route->get('blogs/{slug}', 'PublicController@blogDetail')->name('public.blogDetail');
$route->get('faq', 'PublicController@faq')->name('public.faq');

/*booking system*/
$route->post('find-customer', 'PublicController@findCustomer')->name('public.findCustomer'); 

/*activate account*/
$route->get('activate-account/{token}', 'PublicController@activateAccount')->name('public.activateAccount');
$route->post('resend-activate', 'PublicController@reSendEmailActivate')->name('public.resendActivate');

/*logout*/ 
$route->get('logout', 'CustomerController@logout')->name('public.logout');


/*login*/ 
$route->post('login', 'PublicController@doLogin')->name('public.login');
/*register*/
$route->post('register', 'PublicController@doRegister')->name('public.register');



/*social media*/
$route->get('fb-login', 'PublicController@fbLogin')->name('public.fbLogin');
$route->get('fb-connect', 'PublicController@fbConnect');
$route->get('google-login', 'PublicController@googleLogin')->name('public.googleLogin');
$route->get('google-connect', 'PublicController@googleConnect'); 



/*booking*/
$route->post('get-snap-token', 'CustomerController@getSnapToken')->name('public.getSnapToken');
/*dashboard*/
$route->get('dashboard', 'CustomerController@dashboard')->name('public.dashboard');
$route->get('booking-history', 'CustomerController@bookingHistory')->name('public.bookingHistory');
/*update profile*/
$route->post('update-profile', 'CustomerController@updateProfile')->name('public.updateProfile');

$route->get('login', function(){
})->name('login');