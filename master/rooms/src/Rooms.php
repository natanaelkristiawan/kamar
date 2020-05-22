<?php
namespace Master\Rooms;
use Master\Rooms\Interfaces\OwnersRepositoryInterface;
use Master\Rooms\Interfaces\TypesRepositoryInterface;
use Master\Rooms\Interfaces\LocationsRepositoryInterface;
use Master\Rooms\Interfaces\AmenetiesRepositoryInterface;;
use Master\Rooms\Interfaces\RoomsRepositoryInterface;
use Master\Rooms\Models\Rooms as ModelRooms;
use Master\Rooms\Models\Types as ModelTypes;

use League\Fractal;
use League\Fractal\Manager;
class Rooms
{
  protected $owners;
  protected $type;
  protected $location;
  protected $ameneties;
  protected $rooms;
 
  public function __construct(
    OwnersRepositoryInterface $owners,
    TypesRepositoryInterface $type,
    LocationsRepositoryInterface $location,
    AmenetiesRepositoryInterface $ameneties,
    RoomsRepositoryInterface $rooms
  )
  {
    $this->owners = $owners;
    $this->type = $type;
    $this->location = $location;
    $this->ameneties = $ameneties;
    $this->rooms = $rooms;
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

  public function getTypesFeatured($include_status = false, $dataLimit = 3, $language = 'id')
  {
    if ($include_status) {
      $this->type->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    $fractal = new Manager();
    $query = $this->type->with(['rooms' => function($q) use ($dataLimit) {
      return $q->limit($dataLimit);
    }])->limit(3)->where(array('is_featured'=>1))->get();
    $resource = new Fractal\Resource\Collection($query, function(ModelTypes $model) use ($language) {
      $resource = array();
      if ((bool)count($model->rooms)) {  
        $fractalInside = new Manager();
        $rooms = self::renderRooms($model->rooms, $language);
        $resource = $fractalInside->createData($rooms)->toArray()['data'];
      }
      return [
        'id' => (int) $model->id,
        'name' => $model->content[$language],
        'slug' => $model->slug,
        'rooms' => $resource
      ];
    });
    $response = $fractal->createData($resource)->toJson();
    return $response;
  }

  protected function renderRooms($query, $language)
  {
    return new Fractal\Resource\Collection($query, function(ModelRooms $model) use ($language) {
      return [
        'id' => (int) $model->id,
        'meta'=> $model->meta[$language],
        'name'=> $model->name,
        'slug'=> $model->slug,
        'location_id' => $model->location_id,
        'location' => $model->location->name,
        'owner_id' => $model->owner_id,
        'type_id' => $model->type_id,
        'type_content' => $model->type->content[$language],
        'address' => $model->address,
        'address_detail' => $model->address_detail[$language],
        'latitude' => $model->latitude,
        'longitude' => $model->longitude,
        'photo_primary' => $model->photo_primary,
        'gallery' => $model->gallery,
        'youtube' => $model->youtube,
        'ameneties_ids' => $model->ameneties_ids,
        'title' => $model->title[$language],
        'abstract' => $model->abstract[$language],
        'description' => $model->description[$language],
        'house_rules' => $model->house_rules[$language],
        'price' => $model->price,
        'date_off' => $model->date_off,
        'total_room' => $model->total_room,
        'is_featured' => $model->is_featured,
        'status' => $model->status,
      ];
    });
  }

  public function getFeaturedRooms($include_status = false, $limit = 6, $language = 'id')
  {
    if ($include_status) {
      $this->type->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    $fractal = new Manager();
    $query =  $this->rooms->with(['location', 'type'])->limit($limit)->where(array('is_featured'=>1))->get();
    $resource = self::renderRooms($query, $language);
    $response = $fractal->createData($resource)->toJson();
    return $response;
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