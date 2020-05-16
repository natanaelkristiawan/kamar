<?php

namespace Master\Rooms\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class RoomsPresenter extends FractalPresenter {
  public function getTransformer()
  {
    return new RoomsTransformer();
  }
}