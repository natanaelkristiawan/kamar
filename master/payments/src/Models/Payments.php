<?php

namespace Master\Payments\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model 
{
	use SoftDeletes;
	protected $table = 'payments';
	protected $fillable = [
		'name',
		'slug',
		'status',
	];
}
