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
		'review_id',
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

	protected $casts = [
		'notes' => 'array'
	];
	public function customer()
	{
		return $this->belongsTo(\Master\Customers\Models\Customers::class, 'customer_id', 'id');
	}
	
	public function room()
	{
		return $this->belongsTo(\Master\Rooms\Models\Rooms::class, 'room_id', 'id');
	}

	public function payment()
	{
		return $this->belongsTo(\Master\Payments\Models\Payments::class, 'payment_id', 'id');
	}
}
