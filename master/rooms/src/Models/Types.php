<?php

namespace Master\Rooms\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Types extends Model 
{
  use SoftDeletes;
  protected $table = 'types';
  protected $fillable = [
    'name',
    'slug',
    'is_featured',
    'status',
    'content'
  ];

  protected $casts = array(
    'content' => 'array'
  );


  public function rooms()
  {
    return $this->hasMany(\Master\Rooms\Models\Rooms::class, 'type_id', 'id');
  }
}
