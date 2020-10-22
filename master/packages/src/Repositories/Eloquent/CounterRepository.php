<?php

namespace Master\Packages\Repositories\Eloquent;

use Master\Packages\Interfaces\CounterRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class CounterRepository extends BaseRepository implements CounterRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'owner_id'  => '=',
		'room_id'   => '=',
		'status'    => '='
	];

	public function model()
	{
		return \Master\Packages\Models\Counter::class;
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


	public function getDataTable()
	{        
		$data = $this->paginate($this->pageLimit);
		$data['recordsTotal'] = $data['meta']['pagination']['total'];
		$data['recordsFiltered'] = $data['meta']['pagination']['total'];
		$data['request'] = request()->all();
		return $data;
	}

}
