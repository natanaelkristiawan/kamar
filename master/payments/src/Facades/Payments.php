<?php

namespace Master\Payments\Facades;

use Illuminate\Support\Facades\Facade;

class Payments extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.payments';
	}
}
