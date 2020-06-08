<?php

namespace Master\Books\Repositories\Eloquent;

use Master\Books\Interfaces\BooksRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class BooksRepository extends BaseRepository implements BooksRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
	];

	public function model()
	{
		return \Master\Books\Models\Books::class;
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

	protected function filterDate($query, $table, $filter, $appendTime = true)
	{
		$singleSearchDate = true;
		if (!(bool)empty($filter['date_start']) && !(bool)empty($filter['date_end'])) {
			$singleSearchDate = false;
			if ($appendTime) {
				$query->whereBetween('books.'.$table, array($filter['date_start'].' 00:00:01', $filter['date_end'].' 23:59:59' ));
			} else {
				$query->whereBetween('books.'.$table, array($filter['date_start'], $filter['date_end'] ));
			}
		}
		if ($singleSearchDate) {
			if (!(bool)empty($filter['date_start'])) {
				if ($appendTime) {
					$query->where('books.'.$table, '>=', $filter['date_start'].' 00:00:01');
				} else {
					$query->where('books.'.$table, '>=', $filter['date_start']);
				}
			}
			if (!(bool)empty($filter['date_end'])) {
				if ($appendTime) {
					$query->where('books.'.$table, '<=', $filter['date_end'].' 23:59:59');
				} else {
					$query->where('books.'.$table, '<=', $filter['date_end']);
				}
			}
		}
		return $query;
	}


	public function customFilters($request)
	{
	 	$this->scopeQuery(function($query) use ($request) {
			$query->join('customers', 'customers.id', '=', 'books.customer_id')
      ->join('rooms', 'rooms.id', '=', 'books.room_id')
      ->select('books.*','customers.email', 'rooms.name as roomName');
      $query->with(['customer', 'room']);
      $filter = $request->search;
      $query->whereHas('customer', function ($query) use ($filter) {
      	if ( !(bool)empty($filter['email']) ) {
					$query->where('email', 'like', '%'.$filter['email'].'%');
      	}
			});
      if (!(bool)empty($filter['uuid'])) {
				$query->where('uuid', 'like', '%'.$filter['uuid'].'%');
      }
      $query->whereHas('room', function ($query) use ($filter) {
        if (!(bool)empty($filter['roomName'])) {
        	$query->where('name', 'like', '%'.$filter['roomName'].'%');
        }
			});
			$dateFilter = $filter['date_filter'];
			if ($dateFilter == 'created_at') {
				$query = self::filterDate($query, 'created_at', $filter, true);
			}
			if ($dateFilter == 'checkin') {
				$query = self::filterDate($query, 'date_checkin', $filter, false);
			}
			if ($dateFilter == 'checkout') {
				$query = self::filterDate($query, 'date_checkout', $filter, false);
			}
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
