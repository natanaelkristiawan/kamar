<?php

namespace Master\Rooms\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class LocationsPresenter extends FractalPresenter {
  public function getTransformer()
  {
    return new LocationsTransformer();
  }
}