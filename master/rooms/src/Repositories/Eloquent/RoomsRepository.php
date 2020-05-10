<?php

namespace Master\Rooms\Repositories\Eloquent;

use Master\Rooms\Interfaces\RoomsRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class RoomsRepository extends BaseRepository implements RoomsRepositoryInterface
{
	public function model()
	{
		return \Master\Rooms\Models\Rooms::class;
	}
	public function newInstance(array $attributes)
	{
		$model = $this->model->newInstance($attributes);
		$this->resetModel();
		return $this->parserResult($model);
	}
}
