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

}