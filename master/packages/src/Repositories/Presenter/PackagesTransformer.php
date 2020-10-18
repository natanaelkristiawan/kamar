<?php

namespace Master\Packages\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class PackagesTransformer extends TransformerAbstract
{
	public function transform(\Master\Packages\Models\Packages $model)
	{
		switch ($model->status) {
			case '1':
				$status = 'Active';
				break;
			case '2':
				$status = 'Exhausted Limit';
				break;
			default:
				$status = 'Draft';
				break;
		}

		return [
			'id'   	=> $model->id,
			'owner' => $model->owner->name,
			'total_quota' 	=> $model->total_quota,
			'used_quota'	=> $model->used_quota,
			'remaining_quota' => $model->remaining_quota,
			'date_start' => $model->date_start,
			'date_stop' => $model->date_end,
			'status' => $status,
			'action'=> '<div class="btn-group">
                <a href="'.route('admin.packages.edit', ['id'=>$model->id]).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-fw fa-pencil-alt"></i></a>
                <a href="'.route('admin.packages.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                </div>'
			];
		];
	}
}
