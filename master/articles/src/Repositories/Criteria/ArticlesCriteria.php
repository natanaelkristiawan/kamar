<?php

namespace Master\Articles\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ArticlesCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
    $model = $model->where('status', 1);
    return $model;
	}
}