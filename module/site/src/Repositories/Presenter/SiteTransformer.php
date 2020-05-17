<?php

namespace Module\Site\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class SiteTransformer extends TransformerAbstract
{
	public function transform(\Module\Site\Models\Site $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
			'status'=> '',
			'action'=> ''
		];
	}
}
