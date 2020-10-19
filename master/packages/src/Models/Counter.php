<?php

namespace Master\Packages\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Counter extends Model 
{
	use SoftDeletes;
	protected $table = 'package_counter';
	protected $fillable = [
		'package_id',
		'ip',
		'fingerprint',
		'owner_id',
		'room_id',
	];


	public function owner()
	{
		return $this->belongsTo(\Master\Rooms\Models\Owners::class, 'owner_id');
	}


	public function package()
	{
		return $this->belongsTo(\Master\Packages\Models\Packages::class, 'package_id');
	}

	public function room()
	{
		return $this->belongsTo(\Master\Rooms\Models\Rooms::class, 'room_id');
	}
}
