<?php

namespace Master\Rooms\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rooms extends Model 
{
	use SoftDeletes;
	protected $table = 'rooms';
	protected $fillable = [
    'meta',
    'name',
    'slug',
    'location_id',
    'owner_id',
    'type_id',
    'address',
    'address_detail',
    'latitude',
    'longitude',
    'photo_primary',
    'gallery',
    'youtube',
    'ameneties_ids',
    'title',
    'abstract',
    'description',
    'house_rules',
    'price',
    'date_off',
    'total_room',
    'is_featured',
    'status',
	];


  protected $casts = array(
    'gallery'=> 'array',
    'ameneties_ids'=> 'array',
    'description'=> 'array',
    'title' => 'array',
    'abstract' => 'array',
    'description' => 'array',
    'house_rules' => 'array',
    'meta' => 'array',
    'date_off' => 'array',
    'address_detail' => 'array'
  );


  public function owner()
  {
    return $this->belongsTo(\Master\Rooms\Models\Owners::class, 'owner_id', 'id');
  }
  
  public function location()
  {
    return $this->belongsTo(\Master\Rooms\Models\Locations::class, 'location_id', 'id');
  }

  public function type()
  {
    return $this->belongsTo(\Master\Rooms\Models\Types::class, 'type_id', 'id');
  }
}
