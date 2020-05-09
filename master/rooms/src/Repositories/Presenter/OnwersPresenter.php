<?php

namespace Master\Rooms\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class OwnersPresenter extends FractalPresenter {
  public function getTransformer()
  {
    return new OwnersTransformer();
  }
}