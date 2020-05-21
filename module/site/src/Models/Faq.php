<?php

namespace Module\Site\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model 
{
  use SoftDeletes;
  protected $table = 'faq';
  protected $fillable = [
    'faq_category_id',
    'name',
    'slug',
    'title',
    'description',
    'status',
  ];

  protected $casts = array(
    'title' => 'array',
    'description' => 'array'
  );
}
