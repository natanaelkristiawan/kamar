<?php

namespace Module\Site\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class FaqTransformer extends TransformerAbstract
{
  public function transform(\Module\Site\Models\Faq $model)
  {
    return [
      'id'   => $model->id,
      'name' => $model->name,
      'status'=> $model->status == 0 ? 'Draft' : 'Live',
      'action'=> '<div class="btn-group">
                  <a href="'.route('admin.faq.edit', ['id'=>$model->id]).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-fw fa-pencil-alt"></i></a>
                  <a href="'.route('admin.faq.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                  </div>'
    ];
  }
}
