<?php

namespace Master\Rooms\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model 
{
	use SoftDeletes;
	protected $table = 'rooms';
	protected $fillable = [
    'name',
    'slug',
    'meta',
    'location_id',
    'owner_id',
    'type_id',
    'address',
    'latitude',
    'longitude',
    'photo_primary',
    'gallery',
    'youtube',
    'ameneties_ids',
    'description',
    'price',
    'date_off',
    'total_room',
    'status',
	];


  protected $casts = array(
    'gallery'=> 'array',
    'ameneties_ids'=> 'array',
    'description'=> 'array',
  );
}
