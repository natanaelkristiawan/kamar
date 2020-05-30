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

$route->get('login', function(){
})->name('login');