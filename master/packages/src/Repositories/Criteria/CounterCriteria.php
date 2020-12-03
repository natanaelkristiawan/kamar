<?php

namespace Master\Packages\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class CounterCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
		return $model->with(['owner','room'])->whereHas('room', function($query){
			return $query->where('status', 1);
		})->whereHas('owner', function($query){
			return $query->where('status', 1);
		});
	}
}