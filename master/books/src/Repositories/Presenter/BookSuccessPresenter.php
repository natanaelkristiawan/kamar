<?php

namespace Master\Books\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class BookSuccessPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new BookSuccessTransformer();
	}
}