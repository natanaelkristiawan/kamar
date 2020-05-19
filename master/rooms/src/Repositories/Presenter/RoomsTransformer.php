<?php

namespace Master\Rooms\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class RoomsTransformer extends TransformerAbstract
{
  public function transform(\Master\Rooms\Models\Rooms $model)
  {
    return [
      'id'   => $model->id,
      'photo' => '<a href="#" data-featherlight="'.url('image/original/'.$model->photo_primary).'"><img style="width:100px;border-radius:5px;" class="img-fluid"  src="'.url('image/profile/'.$model->photo_primary).'" /></a>',
      'name' => $model->name,
      'owner' => $model->owner->name,
      'type' => $model->type->name,
      'location' => $model->location->name,
      'address' => $model->address,
      'status'=> $model->status == 0 ? 'Draft' : 'Live',
      'action'=> '<div class="btn-group">
                  <a href="'.route('admin.rooms.edit', ['id'=>$model->id]).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-fw fa-pencil-alt"></i></a>
                  <a href="'.route('admin.rooms.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                  </div>'
    ];
  }
}
