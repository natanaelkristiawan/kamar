<?php

namespace Module\Site\Repositories\Eloquent;

use Module\Site\Interfaces\BookmarkRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class BookmarkRepository extends BaseRepository implements BookmarkRepositoryInterface
{

	protected $fieldSearchable = [];

	public function model()
	{
		return \Module\Site\Models\Bookmark::class;
	}

	public function newInstance(array $attributes)
	{
		$model = $this->model->newInstance($attributes);
		$this->resetModel();
		return $this->parserResult($model);
	}
}
