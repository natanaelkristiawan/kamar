<?php

namespace Master\Rooms\Facades;

use Illuminate\Support\Facades\Facade;

class Rooms extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.rooms';
	}
}
