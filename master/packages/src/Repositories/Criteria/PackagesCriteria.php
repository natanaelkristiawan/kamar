<?php

namespace Master\Packages\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PackagesCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
		return $model;
	}
}