<?php

namespace Master\Payments\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PaymentsTransformer extends TransformerAbstract
{
	public function transform(\Master\Payments\Models\Payments $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
			'status'=> '',
			'action'=> ''
		];
	}
}
