<?php

namespace Master\Reviews\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reviews extends Model 
{
	use SoftDeletes;
	protected $table = 'reviews';
	protected $fillable = [
		'book_id',
		'room_id',
		'customer_id',
		'review',
		'status',
	];


	public function book()
	{
		return $this->belongsTo(\Master\Books\Models\Books::class, 'book_id', 'id');
	}

	public function room()
	{
		return $this->belongsTo(\Master\Rooms\Models\Rooms::class, 'room_id', 'id');
	}

	public function customer()
	{
		return $this->belongsTo(\Master\Customers\Models\Customers::class, 'customer_id', 'id');
	}
}
