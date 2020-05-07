<?php

namespace Master\Books\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model 
{
	use SoftDeletes;
	protected $table = 'books';
	protected $fillable = [
		'name',
		'slug',
		'status',
	];
}
