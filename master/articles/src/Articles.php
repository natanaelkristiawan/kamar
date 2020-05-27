<?php
namespace Master\Articles;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Master\Articles\Interfaces\ArticlesRepositoryInterface;
use Master\Articles\Interfaces\ArticlesToCategoryRepositoryInterface;
use Master\Articles\Interfaces\CategoriesRepositoryInterface;
use Illuminate\Http\Request;
use Master\Articles\Models\Articles as ModelArticles;
use DB;
class Articles
{

  protected $articles;
  protected $articlesToCategory;
  protected $category;
 
  public function __construct(
    ArticlesRepositoryInterface $articles,
    ArticlesToCategoryRepositoryInterface $articlesToCategory,
    CategoriesRepositoryInterface $category
  )
  {
    $this->articles = $articles;
    $this->articlesToCategory = $articlesToCategory;
    $this->category = $category;
  }

  protected function renderArticles($query, $language)
  {
    return new Collection($query, function(ModelArticles $model) use ($language) {
      return [
        'id' => $model->id,
        'meta' => $model->meta[$language],
        'slug' => $model->slug,
        'banners' => $model->banners,
        'banners_mobile' => $model->banners_mobile,
        'title' => $model->title[$language],
        'abstract' => $model->abstract[$language],
        'content' => $model->content[$language],
        'images' => $model->images,
        'category' => isset($model->categories[0]) ? $model->categories[0]->category->title : '',
        'created_at' => date('d F Y', strtotime($model->created_at))
      ];
    });
  }
  public function getArticles(Request $request, $limit = 4 ,$language = 'id')
  {
    $this->articles->pushCriteria(\Master\Articles\Repositories\Criteria\LiveCriteria::class);
    $data =  $this->articles->with(['categories'])->whereHas('categories', function($query) use($request) {
      if ($request->category) {
        $this->category->resetModel();
        $category = $this->category->findWhere(array('slug'=>$request->category, 'status'=>1))->first();
        if (is_null($category)) {
          return $query->where('category_id', null);
        }

        return $query->where('category_id', $category->id);
      }
      return $query;
    })->paginate($limit);
    $query = $data->getCollection();
    $resource = self::renderArticles($query, $language);
    $resource->setPaginator(new IlluminatePaginatorAdapter($data));
    $fractal = new Manager();
    $response = $fractal->createData($resource)->toJson();
    $this->articles->resetModel();
    $this->articles->resetCriteria();
    return $response;
  }


  public function getArticleBefore($article_id = 0)
  {
    $this->articles->pushCriteria(\Master\Articles\Repositories\Criteria\LiveCriteria::class);
    $data = $this->articles->where('id', '<', $article_id)->orderBy('id','desc')->first();
    $this->articles->resetModel();
    $this->articles->resetCriteria();
    if (is_null($data)) {
      return false;
    }
    return $data->slug;
  }

  public function getArticleAfter($article_id = 0)
  {
    $this->articles->pushCriteria(\Master\Articles\Repositories\Criteria\LiveCriteria::class);
    $data = $this->articles->where('id', '>', $article_id)->orderBy('id')->first();
    $this->articles->resetModel();
    $this->articles->resetCriteria();

    if (is_null($data)) {
      return false;
    }
    return $data->slug;
  }


  public function countArticleByCategory()
  {
    $data = $this->articlesToCategory->scopeQuery(function($query){
      return $query->select(DB::raw('count(*) as `article_count`, `category_id`, `categories`.`title`, `categories`.`slug`'))->groupBy('category_id')
      ->join('categories', 'article_to_category.category_id', '=', 'categories.id');
    })->all();
    $this->articlesToCategory->resetModel();
    $this->articlesToCategory->resetCriteria();
    return $data;
  }


  public function getLatestArticle($ids=array(), $limit=5, $language = 'id')
  {
    $this->articles->pushCriteria(\Master\Articles\Repositories\Criteria\LiveCriteria::class);
    $query =  $this->articles->scopeQuery(function($query) use ($limit){
      return $query->limit($limit)->orderBy('id', 'DESC');
    })->findWhereNotIn('id', $ids);
    $resource = self::renderArticles($query, $language);
    $fractal = new Manager();
    $response = $fractal->createData($resource)->toJson();
    $this->articles->resetModel();
    $this->articles->resetCriteria();
    return $response;
  }

  public function getArticleBySlug($slug = '', $language = 'id')
  {
    $this->articles->pushCriteria(\Master\Articles\Repositories\Criteria\LiveCriteria::class);
    $query = $this->articles->with(['categories'])->findWhere(array('slug'=>$slug));
    $resource = self::renderArticles($query, $language);
    $fractal = new Manager();
    $response = $fractal->createData($resource)->toJson();
    $this->articles->resetModel();
    $this->articles->resetCriteria();
    return $response;
  }
}