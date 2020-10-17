<?php

namespace Master\Packages\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PackagesTransformer extends TransformerAbstract
{
	public function transform(\Master\Packages\Models\Packages $model)
	{
		return [
			'id'   	=> $model->id,
			'owner' => $model->owner->name,
			'total_quota' 	=> $model->total_quota,
			'used_quota'	=> $model->used_quota,
			'remaining_quota' => $model->remaining_quota,
			'date_start' => $model->date_start,
			'date_stop' => $model->date_end,
			'status' => '',
			'action' => ''
		];
	}
}
