<?php

namespace Master\Payments\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payments extends Model 
{
	use SoftDeletes;
	protected $table = 'payments';
	protected $fillable = [
		'id',
		'order_id',
		'status_code',
		'status_message',
		'transaction_id',
		'transaction_status',
		'details',
	];

	protected $casts = array(
		'details' => 'array'
	);
}
