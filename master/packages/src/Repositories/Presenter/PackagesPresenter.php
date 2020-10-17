<?php

namespace Master\Packages\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class PackagesPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new PackagesTransformer();
	}
}