<?php

namespace Master\Rooms\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class AmenetiesPresenter extends FractalPresenter {
  public function getTransformer()
  {
    return new AmenetiesTransformer();
  }
}