<?php

namespace Module\Site\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class FaqCategoriesPresenter extends FractalPresenter {
  public function getTransformer()
  {
    return new FaqCategoriesTransformer();
  }
}