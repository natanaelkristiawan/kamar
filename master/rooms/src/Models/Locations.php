<?php

namespace Master\Rooms\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locations extends Model 
{
  use SoftDeletes;
  protected $table = 'locations';
  protected $fillable = [
    'name',
    'slug',
    'status'
  ];
}
