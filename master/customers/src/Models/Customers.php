<?php

namespace Master\Customers\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model 
{
	use SoftDeletes;
	protected $table = 'customers';
	protected $fillable = [
		'name',
		'slug',
		'status',
	];
}
