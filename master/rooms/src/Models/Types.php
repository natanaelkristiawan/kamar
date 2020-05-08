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
    'status',
    'content'
  ];

  protected $casts = array(
    'content' => 'array'
  );
}
