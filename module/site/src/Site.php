<?php
namespace Module\Site;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Module\Site\Interfaces\SiteRepositoryInterface;
use Module\Site\Interfaces\FaqCategoriesRepositoryInterface;
use Module\Site\Interfaces\BookmarkRepositoryInterface;
use Illuminate\Http\Request;
use Module\Site\Models\Bookmark as ModelBookmark;

class Site
{

  protected $repository;
  protected $faq;
  protected $bookmark;

  public function __construct(
    SiteRepositoryInterface $repository,
    FaqCategoriesRepositoryInterface $faq,
    BookmarkRepositoryInterface $bookmark
  )
  {
    $this->repository = $repository;
    $this->faq = $faq;
    $this->bookmark = $bookmark;
  }

  public function getDataSite($slug = '', $multilang = false)
  {
    $query = $this->repository->findWhere(array('slug' => $slug))->first();
    if (is_null($query)) {
      if ($multilang) {
        return $this->repository->newInstance([]);
      }
      return null;
    }
    return $query->value;
  }


  public function getFaqData()
  {
    $query = $this->faq->with(['contents' => function($query){
      return $query->where('status', 1);
    }])->all();
    $this->faq->resetModel();
    return $query;
  }


  public function setBookmark($attribute, $params)
  {
    $query = $this->bookmark->updateOrCreate($attribute, $params);
    $this->bookmark->resetModel();
    return $query;
  }

  public function isBookmark($params)
  {
    $query = $this->bookmark->findWhere($params)->first();
    $this->bookmark->resetModel();
    return $query;
  }


  protected function renderBookmark($query)
  {
    return new Collection($query, function(ModelBookmark $model){
      return [
        'id' => (int) $model->id,
        'room' => $model->room->name,
        'room_image' => $model->room->photo_primary,
        'room_slug' => $model->room->slug,
        'room_location' => $model->room->location->name,
        'created_at' => date('d F Y H:i:s', strtotime($model->created_at)) 
      ];
    });
  }


  public function findBookmarkByCustomer(Request $request, $customer_id, $limit = 4)
  {
    $data = $this->bookmark->with(['room'])->scopeQuery(function($query) use ($customer_id) {
      return $query->where(array('customer_id'=>$customer_id, 'status' =>1));
    })->paginate($limit);

    $query = $data->getCollection();
    $resource = self::renderBookmark($query);
    $resource->setPaginator(new IlluminatePaginatorAdapter($data));
    $fractal = new Manager();
    $response = $fractal->createData($resource)->toJson();
    $this->bookmark->resetModel();
    return $response;
  }

}