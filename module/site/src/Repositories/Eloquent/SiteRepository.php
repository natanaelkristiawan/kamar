<?php

namespace Module\Site\Repositories\Eloquent;

use Module\Site\Interfaces\SiteRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class SiteRepository extends BaseRepository implements SiteRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'name'      => 'like',
		'status'    => '='
	];

	public function model()
	{
		return \Module\Site\Models\Site::class;
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
