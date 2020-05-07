<?php

namespace Master\Articles\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class ArticlesTransformer extends TransformerAbstract
{
	public function transform(\Master\Articles\Models\Articles $model)
	{
		return [
			'id'   => $model->id,
			'title' => $model->title,
			'abstract' => $model->abstract,
			'status'=> $model->status == 0 ? 'Draft' : 'Live',
			'action'=> '<div class="btn-group">
                  <a href="'.route('admin.articles.edit', ['id'=>$model->id]).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-fw fa-pencil-alt"></i></a>
                  <a href="'.route('admin.articles.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                  </div>'
		];
	}
}
