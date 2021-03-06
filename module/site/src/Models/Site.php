<?php

namespace Module\Site\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model 
{
	use SoftDeletes;
	protected $table = 'site';
	protected $fillable = [
		'name',
		'slug',
    'value',
		'status',
	];

  protected $casts = array(
    'value' => 'array'
  );
}
