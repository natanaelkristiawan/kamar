<?php

namespace Master\Rooms\Repositories\Eloquent;

use Master\Rooms\Interfaces\AmenetiesRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class AmenetiesRepository extends BaseRepository implements AmenetiesRepositoryInterface
{
  private $pageLimit;

  protected $fieldSearchable = [
    'name'      => 'like',
    'status'    => '='
  ];

  public function model()
  {
    return \Master\Rooms\Models\Ameneties::class;
  }

  public function newInstance(array $attributes)
  {
    $model = $this->model->newInstance($attributes);
    $this->resetModel();
    return $this->parserResult($model);
  }

  public function setPageLimit($pageLimit)
  {
    $this->pageLimit = $pageLimit;
    return  $this;
  }


  public function getDataTable()
  {        
    $data = $this->paginate($this->pageLimit);
    $data['recordsTotal'] = $data['meta']['pagination']['total'];
    $data['recordsFiltered'] = $data['meta']['pagination']['total'];
    $data['request'] = request()->all();
    return $data;
  }

}
