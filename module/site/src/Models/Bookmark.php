<?php

namespace Module\Site\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bookmark extends Model 
{
  use SoftDeletes;
  protected $table = 'bookmark';
  protected $fillable = [
    'customer_id',
    'room_id',
    'status',
  ];

  public function customer()
  {
    return $this->belongsTo(\Master\Customers\Models\Customers::class, 'customer_id', 'id');
  }

  public function room()
  {
    return $this->belongsTo(\Master\Rooms\Models\Rooms::class, 'room_id', 'id');
  }
}
