<?php

namespace Module\Site\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class FaqPresenter extends FractalPresenter {
  public function getTransformer()
  {
    return new FaqTransformer();
  }
}