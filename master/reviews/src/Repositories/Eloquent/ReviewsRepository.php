<?php

namespace Master\Reviews\Repositories\Eloquent;

use Master\Reviews\Interfaces\ReviewsRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class ReviewsRepository extends BaseRepository implements ReviewsRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
	];

	public function model()
	{
		return \Master\Reviews\Models\Reviews::class;
	}

	public function newInstance(array $attributes)
	{
		$model = $this->model->newInstance($attributes);
		$this->resetModel();
		return $this->parserResult($model);
	}

	public function setPageLimit($pageLimit)
	{
		$this->pageLimit = $pageLimit;
		return  $this;
	}



	protected function filterDate($query, $table, $filter)
	{
		$singleSearchDate = true;
		if (!(bool)empty($filter['date_start']) && !(bool)empty($filter['date_end'])) {
			$singleSearchDate = false;
			$query->whereBetween('reviews.'.$table, array($filter['date_start'].' 00:00:01', $filter['date_end'].' 23:59:59' ));
			
		}
		if ($singleSearchDate) {
			if (!(bool)empty($filter['date_start'])) {
				$query->where('reviews.'.$table, '>=', $filter['date_start'].' 00:00:01');
			}
			if (!(bool)empty($filter['date_end'])) {

				$query->where('reviews.'.$table, '<=', $filter['date_end'].' 23:59:59');
			
			}
		}
		return $query;
	}


	public function customFilters($request)
	{
	 	$this->scopeQuery(function($query) use ($request) {
			$query->join('customers', 'customers.id', '=', 'reviews.customer_id')
      ->join('rooms', 'rooms.id', '=', 'reviews.room_id')
      ->join('books', 'books.id', '=', 'reviews.book_id')
      ->select('reviews.*','customers.email', 'rooms.name as roomName');
      $query->with(['customer', 'room']);
      $filter = $request->search;
      $query->whereHas('customer', function ($query) use ($filter) {
      	if ( !(bool)empty($filter['email']) ) {
					$query->where('email', 'like', '%'.$filter['email'].'%');
      	}
			});
      if (!(bool)empty($filter['uuid'])) {
				$query->where('books.uuid', 'like', '%'.$filter['uuid'].'%');
      }
      $query->whereHas('room', function ($query) use ($filter) {
        if (!(bool)empty($filter['roomName'])) {
        	$query->where('rooms.name', 'like', '%'.$filter['roomName'].'%');
        }
			});

			$query = self::filterDate($query, 'created_at', $filter, true);
			
      return $query;
		});
		return $this;
	}




	public function getDataTable()
	{        
		$data = $this->paginate($this->pageLimit);
		$data['recordsTotal'] = $data['meta']['pagination']['total'];
		$data['recordsFiltered'] = $data['meta']['pagination']['total'];
		$data['request'] = request()->all();
		return $data;
	}

}
