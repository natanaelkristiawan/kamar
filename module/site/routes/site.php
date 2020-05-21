<?php 
$route->get('/', 'PublicController@index')->name('public.index');
$route->get('login', function(){
})->name('login');