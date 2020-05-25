<?php

namespace Master\Articles\Models;
use Illuminate\Database\Eloquent\Model;

class ArticlesToCategory extends Model 
{
	protected $table = 'article_to_category';
	protected $fillable = [
		'article_id',
		'category_id',
	];

	public function category()
	{
		return $this->belongsTo(\Master\Articles\Models\Categories::class, 'category_id', 'id');
	}
}
