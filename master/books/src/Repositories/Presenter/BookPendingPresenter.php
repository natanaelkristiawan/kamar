<?php

namespace Master\Books\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class BookPendingPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new BookPendingTransformer();
	}
}