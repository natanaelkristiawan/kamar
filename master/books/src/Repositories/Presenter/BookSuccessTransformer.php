<?php

namespace Master\Books\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class BookSuccessTransformer extends TransformerAbstract
{
	public function transform(\Master\Books\Models\Books $model)
	{
		return [
			'id'   => $model->id,
			'uuid'   => $model->uuid,
			'payment'   => isset($model->payment->id) ? '' : $model->payment->id,
			'created_at' =>  date('Y-m-d H:i:s', strtotime($model->created_at)),
			'email' => $model->email,
			'roomName' => $model->roomName,
			'rooms' => $model->rooms,
			'guests' => $model->guests,
			'nights' => $model->nights,
			'price' => $model->price,
			'total' => $model->total,
			'service' => $model->service,
			'grand_total' => $model->grand_total,
			'date_checkin' => $model->date_checkin,
			'date_checkout' => $model->date_checkout,
			'status' => (bool)$model->status ? 'Success Payment' : 'Pending Payment',
		];
	}
}
