<?php
namespace Master\Articles;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Master\Articles\Interfaces\ArticlesRepositoryInterface;
use Illuminate\Http\Request;
use Master\Articles\Models\Articles as ModelArticles;
class Articles
{

  protected $articles;
 
  public function __construct(
    ArticlesRepositoryInterface $owners,
  )
  {
    $this->articles = $articles;
  }


  public function getArticles(Request $request, $limit = 1, $language = 'id')
  {
    # code...
  }


}