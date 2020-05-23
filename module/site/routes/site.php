<?php 
$route->get('/', 'PublicController@index')->name('public.index');

$route->get(LaravelLocalization::transRoute('routes.roomDetail'), 'PublicController@detailRoom')->name('public.roomDetail');

$route->get(LaravelLocalization::transRoute('routes.rooms'), 'PublicController@rooms')->name('public.rooms');
$route->get('login', function(){
})->name('login');