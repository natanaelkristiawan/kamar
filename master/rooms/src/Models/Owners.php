<?php

namespace Master\Rooms\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Owners extends Model 
{
  use SoftDeletes;
  protected $table = 'owners';
  protected $fillable = [
    'name',
    'photo',
    'email',
    'phone',
    'status'
  ];
}
