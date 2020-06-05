<?php

namespace Master\Payments\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class PaymentsCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
		return $model->where('status_code', 200);
	}
}