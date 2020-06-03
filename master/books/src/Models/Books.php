<?php

namespace Master\Books\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model 
{
	use SoftDeletes;
	protected $table = 'books';
	protected $fillable = [
		'uuid',
		'customer_id',
		'room_id',
		'payment_id',
		'rooms',
		'guests',
		'nights',
		'price',
		'total',
		'service',
		'grand_total',
		'date_checkin',
		'date_checkout',
		'notes',
		'status',
	];
}
