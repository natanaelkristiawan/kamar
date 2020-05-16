<?php

namespace Master\Customers\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class CustomersTransformer extends TransformerAbstract
{
	public function transform(\Master\Customers\Models\Customers $model)
	{
		return [
			'id'   => $model->id,
      'created_at' =>  date('Y-m-d H:i:s', strtotime($model->created_at)),
      'name' => $model->name,
      'email' => $model->email,
      'gender' => $model->gender,
      'dob' => $model->dob,
      'phone' => $model->phone,
      'photo' => '<a href="#" data-featherlight="'.url('image/original/'.$model->photo).'"><img style="max-width:100px;border-radius:5px;" class="img-fluid"  src="'.url('image/profile/'.$model->photo).'" /></a>',
      'status' => $model->status == 0 ? 'Draft' : 'Live',
		  'action'=> '<div class="btn-group">
                <a href="'.route('admin.customers.edit', ['id'=>$model->id]).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-fw fa-pencil-alt"></i></a>
                <a href="'.route('admin.customers.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                </div>'
		];
	}
}
