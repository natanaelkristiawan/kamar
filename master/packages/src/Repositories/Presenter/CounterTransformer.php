<?php

namespace Master\Packages\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class CounterTransformer extends TransformerAbstract
{
	public function transform(\Master\Packages\Models\Counter $model)
	{

		$room_id = null;
		$owner_id = null;

		if (count($model->room)) {
			$room = $model->room->name
		}

		if (count($model->owner_id)) {
			$$owner_id = $model->owner->name;
		}


		return [
			'id'   	=> $model->id,
			'created_at' => date('Y-m-d', strtotime($model->created_at)),
			'ip'	=> $model->ip,
			'fingerprint' => $model->fingerprint,
			'room_id' => $room_id,
			'owner_id' => $owner_id,
		];
	}
}
