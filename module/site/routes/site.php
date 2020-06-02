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

/*social media*/
$route->get('fb-login', 'PublicController@fbLogin')->name('public.fbLogin');
$route->get('fb-connect', 'PublicController@fbConnect');
$route->get('google-login', 'PublicController@googleLogin')->name('public.googleLogin');
$route->get('google-connect', 'PublicController@googleConnect'); 



/*booking*/
$route->post('get-snap-token', 'CustomerController@getSnapToken')->name('public.getSnapToken');

$route->get('login', function(){
})->name('login');