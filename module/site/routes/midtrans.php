<?php

/*capture all from midtrans*/
$route->any('4Yp1yZrQtuBLckRHNz80', 'PublicController@captureMidtrans');
$route->any('callback-success', 'PublicController@callbackSuccess');