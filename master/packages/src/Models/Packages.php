<?php

namespace Master\Packages\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model 
{
	use SoftDeletes;
	protected $table = 'packages';
	protected $fillable = [
		'owner_id',
		'total_quota',
		'used_quota',
		'remaining_quota',
		'date_start',
		'date_end',
		'status',
	];


	public function owner()
	{
		return $this->belongsTo(\Master\Rooms\Models\Owners::class, 'owner_id');
	}
}
