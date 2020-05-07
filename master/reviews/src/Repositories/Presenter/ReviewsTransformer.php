<?php

namespace Master\Reviews\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class ReviewsTransformer extends TransformerAbstract
{
	public function transform(\Master\Reviews\Models\Reviews $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
			'status'=> '',
			'action'=> ''
		];
	}
}
