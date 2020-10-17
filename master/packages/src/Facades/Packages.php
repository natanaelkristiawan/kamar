<?php

namespace Master\Packages\Facades;

use Illuminate\Support\Facades\Facade;

class Packages extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.packages';
	}
}
