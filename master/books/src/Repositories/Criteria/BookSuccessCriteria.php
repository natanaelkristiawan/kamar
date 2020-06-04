<?php

namespace Master\Books\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class BookSuccessCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
		return $model->where('books.status', 1);
	}
}