<?php

namespace Master\Rooms\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model 
{
	use SoftDeletes;
	protected $table = 'rooms';
	protected $fillable = [
		'name',
		'slug',
		'status',
	];
}
