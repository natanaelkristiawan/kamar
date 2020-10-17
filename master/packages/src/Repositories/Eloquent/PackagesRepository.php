<?php

namespace Master\Packages\Repositories\Eloquent;

use Master\Packages\Interfaces\PackagesRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class PackagesRepository extends BaseRepository implements PackagesRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'name'      => 'like',
		'status'    => '='
	];

	public function model()
	{
		return \Master\Packages\Models\Packages::class;
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
