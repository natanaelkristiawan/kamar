<?php

namespace Master\Payments\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PaymentsTransformer extends TransformerAbstract
{
	public function transform(\Master\Payments\Models\Payments $model)
	{
		return [
			'id'   => $model->id,
			'created_at'   => date('Y-m-d H:i:s', strtotime($model->created_at)),
			'order_id'   => $model->order_id,
			'status_code'   => $model->status_code,
			'status_message'   => $model->status_message,
			'transaction_id'   => $model->transaction_id,
			'transaction_status'   => $model->transaction_status,
		];
	}
}
