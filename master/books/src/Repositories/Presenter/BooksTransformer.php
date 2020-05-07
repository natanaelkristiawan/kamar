<?php

namespace Master\Books\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class BooksTransformer extends TransformerAbstract
{
	public function transform(\Master\Books\Models\Books $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
			'status'=> '',
			'action'=> ''
		];
	}
}
