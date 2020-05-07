<?php

namespace Master\Reviews\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class ReviewsPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new ReviewsTransformer();
	}
}