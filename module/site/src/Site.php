<?php
namespace Module\Site;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Module\Site\Interfaces\SiteRepositoryInterface;
use Module\Site\Interfaces\FaqCategoriesRepositoryInterface;
class Site
{

  protected $repository;
  protected $faq;

  public function __construct(
    SiteRepositoryInterface $repository,
    FaqCategoriesRepositoryInterface $faq
  )
  {
    $this->repository = $repository;
    $this->faq = $faq;
  }

  public function getDataSite($slug = '', $multilang = false)
  {
    $query = $this->repository->findWhere(array('slug' => $slug))->first();
    if (is_null($query)) {
      if ($multilang) {
        return $this->repository->newInstance([]);
      }
      return null;
    }
    return $query->value;
  }


  public function getFaqData()
  {
    $query = $this->faq->with(['contents' => function($query){
      return $query->where('status', 1);
    }])->all();
    $this->faq->resetModel();
    return $query;
  }

}