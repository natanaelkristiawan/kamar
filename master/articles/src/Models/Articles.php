<?php

namespace Master\Articles\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articles extends Model 
{
	use SoftDeletes;
	protected $table = 'articles';
	protected $fillable = [
		'name',
		'slug',
		'order',
		'meta',
		'banners',
		'banners_mobile',
		'images',
		'abstract',
    'title',
		'content',
		'is_featured',
    'status',
	];

  protected $casts = [
		'meta' => 'array',
    'abstract' => 'array',
    'title' => 'array',
    'content' => 'array'
  ];


  public function categories()
  {
  	return $this->hasMany(\Master\Articles\Models\ArticlesToCategory::class, 'article_id', 'id');
  }
}
