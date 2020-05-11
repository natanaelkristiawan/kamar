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
    'email',
    'phone',
    'photo',
    'card_id',
    'selfie_with_card_id',
    'bank',
    'bank_code',
    'bank_account',
    'bank_account_photo',
    'status',
  ];
}
