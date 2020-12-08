<?php

namespace Master\Packages\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class CounterTransformer extends TransformerAbstract
{
	public function transform(\Master\Packages\Models\Counter $model)
	{
		return [
			'id'   	=> $model->id,
			'created_at' => date('Y-m-d', strtotime($model->created_at)),
			'ip'	=> $model->ip,
			'fingerprint' => $model->fingerprint,
			'room_id' => $model->room->name,
			'owner_id' => $model->owner_id,
		];
	}
}
