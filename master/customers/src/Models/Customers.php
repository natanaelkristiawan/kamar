<?php

namespace Master\Customers\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Authenticatable 
{
	use SoftDeletes;
  use Notifiable;
	protected $table = 'customers';


  protected $hidden = [
    'password', 'remember_token',
  ];

	protected $fillable = [
  	'id',
    'name',
    'email',
    'password',
    'gender',
    'dob',
    'phone',
    'photo',
    'fb_id',
    'google_id',
    'token_forgot_password',
    'token_verified',
    'remember_token',
    'verified_at',
    'status',
	];
}
