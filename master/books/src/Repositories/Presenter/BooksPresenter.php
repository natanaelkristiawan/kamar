<?php

namespace Master\Books\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class BooksPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new BooksTransformer();
	}
}