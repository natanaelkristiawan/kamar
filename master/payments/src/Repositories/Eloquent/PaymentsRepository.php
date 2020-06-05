<?php

namespace Master\Payments\Repositories\Eloquent;

use Master\Payments\Interfaces\PaymentsRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class PaymentsRepository extends BaseRepository implements PaymentsRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'order_id'      => 'like',
		'transaction_id'      => 'like',
		'created_at' => [
      'default' => array(),
      'condition' => 'between'
    ],
	];

	public function model()
	{
		return \Master\Payments\Models\Payments::class;
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
