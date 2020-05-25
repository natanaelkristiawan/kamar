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
    ArticlesRepositoryInterface $articles
  )
  {
    $this->articles = $articles;
  }

  protected function renderArticles($query, $language)
  {
    return new Collection($query, function(ModelArticles $model) use ($language) {
      return [
        'id' => $model->id,
        'meta' => $model->meta[$language],
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
    $data =  $this->articles->with(['categories'])->paginate($limit);
    $query = $data->getCollection();
    $resource = self::renderArticles($query, $language);
    $resource->setPaginator(new IlluminatePaginatorAdapter($data));
    $fractal = new Manager();
    $response = $fractal->createData($resource)->toJson();
    return $response;

  }
}