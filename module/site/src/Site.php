<?php
namespace Module\Site;
use Module\Site\Interfaces\SiteRepositoryInterface;
class Site
{

  protected $repository;
  public function __construct(SiteRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function getDataSite($slug = '')
  {
    $query = $this->repository->findWhere(array('slug' => $slug))->first();
    
    if (is_null($query)) {
      return null;
    }

    return $query->value;

  }

}