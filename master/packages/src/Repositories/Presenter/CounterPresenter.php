<?php

namespace Master\Packages\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class CounterPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new CounterTransformer();
	}
}