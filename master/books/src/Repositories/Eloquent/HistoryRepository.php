<?php

namespace Master\Books\Repositories\Eloquent;

use Master\Books\Interfaces\HistoryRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class HistoryRepository extends BaseRepository implements HistoryRepositoryInterface
{

	public function model()
	{
		return \Master\Books\Models\History::class;
	}

}
