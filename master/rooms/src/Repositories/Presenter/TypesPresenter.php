<?php

namespace Master\Rooms\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class TypesPresenter extends FractalPresenter {
  public function getTransformer()
  {
    return new TypesTransformer();
  }
}