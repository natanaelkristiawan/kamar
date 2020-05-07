<?php

namespace Master\Reviews\Facades;

use Illuminate\Support\Facades\Facade;

class Reviews extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.reviews';
	}
}
