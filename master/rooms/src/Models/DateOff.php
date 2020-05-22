<?php

namespace Master\Rooms\Models;
use Illuminate\Database\Eloquent\Model;

class DateOff extends Model 
{
  protected $table = 'room_date_off';
  protected $fillable = [
    'room_id',
    'date',
  ];
}
