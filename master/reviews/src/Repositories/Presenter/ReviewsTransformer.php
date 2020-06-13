<?php

namespace Master\Reviews\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class ReviewsTransformer extends TransformerAbstract
{
	public function transform(\Master\Reviews\Models\Reviews $model)
	{


		$button = '<div class="btn-group">
				<a href="javascript:;" onclick="var point = prompt(\'Please enter rating\', \'0\');if (point != null) { window.location.href=\''.route('admin.reviews.confirm', ['id'=>$model->id]).'\'+\'/\'+point ;return true}; return false" class="btn btn-sm btn-success btn-flat"><i class="fas fa-check"></i></a>
				<a href="'.route('admin.reviews.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-primary btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
				</div>';

		if ($model->status) {
			$button = '<div class="btn-group">
				<a href="'.route('admin.reviews.decline', ['id'=>$model->id]).'" onclick="return confirm(\'Are you decline this item?\')" class="btn btn-sm btn-success btn-flat"><i class="fas fa-times"></i></a>
				<a href="'.route('admin.reviews.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-primary btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
				</div>';
		}


		return [
			'id'   	=> $model->id,
			'created_at'   	=> date('Y-m-d H:i:s', strtotime($model->created_at)),
			'email' => $model->customer->email,
			'uuid' => $model->book->uuid,
			'roomName' => $model->room->name,
			'review' => $model->review,
			'rating' => (int)$model->rating,
			'status'=> $model->status == 0 ? 'Draft' : 'Live',
			'action'=> $button
		];
	}
}
