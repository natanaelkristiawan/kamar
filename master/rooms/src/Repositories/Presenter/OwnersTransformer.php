<?php

namespace Master\Rooms\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class OwnersTransformer extends TransformerAbstract
{
  public function transform(\Master\Rooms\Models\Owners $model)
  {
    return [
      'id'   => $model->id,
      'name' => $model->name,
      'email' => $model->email,
      'phone' => $model->phone,
      'status'=> $model->status == 0 ? 'Draft' : 'Live',
      'action'=> '<div class="btn-group">
                  <a href="'.route('admin.owners.edit', ['id'=>$model->id]).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-fw fa-pencil-alt"></i></a>
                  <a href="'.route('admin.owners.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                  </div>'
    ];
  }
}
