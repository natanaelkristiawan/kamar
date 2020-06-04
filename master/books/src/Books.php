<?php
namespace Master\Books;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Master\Books\Interfaces\BooksRepositoryInterface;
use Master\Books\Interfaces\HistoryRepositoryInterface;
use Illuminate\Http\Request;
use Master\Books\Models\Books as ModelBooks;
class Books
{
	protected $book;
	protected $history;

	public function __construct(
		BooksRepositoryInterface $book,
		HistoryRepositoryInterface $history
	)
	{
		$this->book = $book;
		$this->history = $history;
	}

	public function updateOrCreateHistory($attribute, $params)
	{
		$query = $this->history->updateOrCreate($attribute, $params);
		$this->history->resetModel();
		return $query;
	}

	public function findHistory($uuid = '')
	{
		$query = $this->history->findByField('uuid', $uuid)->first();
		$this->history->resetModel();
		return $query;
	}

	public function createBookPending($params)
	{
		$query = $this->book->create($params);
		$this->book->resetModel();
		return $query;
	}

	public function findBook($uuid='')
	{
		$query = $this->book->findByField('uuid', $uuid)->first();
		$this->book->resetModel();
		return $query;
	}

	public function updateBook($id='', $params)
	{
		$query = $this->book->update($params, $id);
		$this->book->resetModel();
		return $query;
	}


	protected function renderBooks($query)
  {
    return new Collection($query, function(ModelArticles $model) {
      return [
        'id' => $model->id,
        'room' => $model->room->name,
        'room_location' => $model->room->location->name,
        'room_image' => $model->room->photo_primary,
        'date_checkin' => $model->date_checkin,
        'date_checkout' => $model->date_checkout,
        'rooms' => $model->rooms,
        'guests' => $model->guests,
        'grand_total' => $model->grand_total
      ];
    });
  }

	public function findPendingBookByCustomer(Request $request, $customer_id = '', $limit = 4 )
	{
		$this->book->pushCriteria(\Master\Books\Repositories\Criteria\BookPendingCriteria::class);
    $data =  $this->book->scopeQuery(function($query){
    	return $query->orderBy('id','desc');
		})->where('customer_id', $customer_id)->paginate($limit);
    $query = $data->getCollection();
    $resource = self::renderBooks($query);
    $resource->setPaginator(new IlluminatePaginatorAdapter($data));
    $fractal = new Manager();
    $response = $fractal->createData($resource)->toJson();
    $this->book->resetModel();
    $this->book->resetCriteria();
    return $response;
	}

}