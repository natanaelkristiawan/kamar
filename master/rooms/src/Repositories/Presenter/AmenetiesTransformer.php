<?php

namespace Master\Rooms\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class AmenetiesTransformer extends TransformerAbstract
{
  public function transform(\Master\Rooms\Models\Ameneties $model)
  {
    return [
      'id'   => $model->id,
      'name' => $model->name,
      'status'=> '',
      'action'=> ''
    ];
  }
}
