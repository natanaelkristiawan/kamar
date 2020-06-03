<?php

namespace Master\Books\Models;
use Illuminate\Database\Eloquent\Model;
class History extends Model 
{
	protected $table = 'book_histories';
	protected $fillable = [
		'uuid',
		'data'
	];

	protected $casts = array(
		'data' => 'array'
	);
}
