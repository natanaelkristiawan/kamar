<?php

namespace Module\Site\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class SitePresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new SiteTransformer();
	}
}