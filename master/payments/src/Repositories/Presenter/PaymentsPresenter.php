<?php

namespace Master\Payments\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class PaymentsPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new PaymentsTransformer();
	}
}