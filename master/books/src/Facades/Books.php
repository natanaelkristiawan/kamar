<?php

namespace Master\Books\Facades;

use Illuminate\Support\Facades\Facade;

class Books extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.books';
	}
}
