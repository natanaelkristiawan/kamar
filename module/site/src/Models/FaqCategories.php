<?php

namespace Module\Site\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqCategories extends Model 
{
  use SoftDeletes;
  protected $table = 'faq_categories';
  protected $fillable = [
    'name',
    'slug',
    'content',
    'status',
  ];

  protected $casts = array(
    'content' => 'array'
  );

  public function contents()
  {
    return $this->hasMany(\Module\Site\Models\Faq::class, 'faq_category_id', 'id');
  }
}
