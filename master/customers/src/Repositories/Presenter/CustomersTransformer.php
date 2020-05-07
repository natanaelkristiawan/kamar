<?php

namespace Master\Customers\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class CustomersTransformer extends TransformerAbstract
{
	public function transform(\Master\Customers\Models\Customers $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
			'status'=> '',
			'action'=> ''
		];
	}
}
