<?php
namespace Master\Rooms;
use Master\Rooms\Interfaces\OwnersRepositoryInterface;
use Master\Rooms\Interfaces\TypesRepositoryInterface;
use Master\Rooms\Interfaces\LocationsRepositoryInterface;
use Master\Rooms\Interfaces\AmenetiesRepositoryInterface;;
class Rooms
{
  protected $owners;
  protected $type;
  protected $location;
  protected $ameneties;
 
  public function __construct(
    OwnersRepositoryInterface $owners,
    TypesRepositoryInterface $type,
    LocationsRepositoryInterface $location,
    AmenetiesRepositoryInterface $ameneties
  )
  {
    $this->owners = $owners;
    $this->type = $type;
    $this->location = $location;
    $this->ameneties = $ameneties;
  }

  public function getOwners($include_status = false)
  {
    if ($include_status) {
      $this->owners->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    return $this->owners->all();
  }

  public function getTypes($include_status = false)
  {
    if ($include_status) {
      $this->type->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    return $this->type->all();
  }

  public function getLocations($include_status = false)
  {
    if ($include_status) {
      $this->location->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    return $this->location->all();
  }

  public function getAmeneties($include_status = false)
  {
    if ($include_status) {
      $this->ameneties->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    return $this->ameneties->all();
  }

}