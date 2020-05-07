<?php

namespace Master\Customers\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class CustomersPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new CustomersTransformer();
	}
}