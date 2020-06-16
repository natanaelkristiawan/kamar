<?php
namespace Master\Rooms;
use Master\Rooms\Interfaces\OwnersRepositoryInterface;
use Master\Rooms\Interfaces\TypesRepositoryInterface;
use Master\Rooms\Interfaces\LocationsRepositoryInterface;
use Master\Rooms\Interfaces\AmenetiesRepositoryInterface;;
use Master\Rooms\Interfaces\RoomsRepositoryInterface;
use Master\Rooms\Models\Rooms as ModelRooms;
use Master\Rooms\Models\Types as ModelTypes;
use Master\Rooms\Models\Ameneties as ModelAmeneties;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

use Illuminate\Http\Request;


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
    $this->owners->resetModel();
    $this->owners->resetCriteria();
    return $this->owners->all();
  }

  public function getTypes($include_status = false)
  {
    if ($include_status) {
      $this->type->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    $this->type->resetModel();
    $this->type->resetCriteria();
    return $this->type->all();
  }

  public function getTypesFeatured($include_status = false, $dataLimit = 3, $language = 'id')
  {
    if ($include_status) {
      $this->type->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    $fractal = new Manager();
    $query = $this->type->with(['rooms'])->limit(3)->where(array('is_featured'=>1))
          ->get()
          ->map(function( $query ) use ($dataLimit) {
            $query->rooms = $query->rooms->take($dataLimit);
            return $query;
          });
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
    $this->type->resetModel();
    $this->type->resetCriteria();
    return $response;
  }

  protected function renderRooms($query, $language)
  {
    return new Collection($query, function(ModelRooms $model) use ($language) {

      $rating = 5;
      $total = 0;
      $data = 0;
      foreach ($model->reviews as $key => $value) {
        if (!(bool)$value->rating) {
          continue;
        }
        $total = $total + $value->rating;
        $data++; 
      }

      if ($total) {
        $rating = $total / $data;
      }


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
        'owner_name'  => $model->owner->name,
        'owner_phone'  => $model->owner->phone,
        'owner_photo'  => $model->owner->photo,
        'reviews' => $model->reviews,
        'status' => $model->status,
        'rating' => $rating
      ];
    });
  }

  public function getFeaturedRooms($include_status = false, $limit = 6, $language = 'id')
  {
    if ($include_status) {
      $this->rooms->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    $fractal = new Manager();
    $query =  $this->rooms->with(['location', 'type', 'owner'])->limit($limit)->where(array('is_featured'=>1))->get();
    $resource = self::renderRooms($query, $language);
    $response = $fractal->createData($resource)->toJson();
    $this->rooms->resetModel();
    $this->rooms->resetCriteria();
    return $response;
  }

  public function getRoomBySlug($slug='', $language = 'id')
  {
    $this->rooms->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    $query = $this->rooms->with(['owner', 'reviews' => function($query){
      return $query->where('status', 1);
    }])->whereHas('owner', function($query){
      return $query->where('status', 1);
    })->findWhere(array('slug'=>$slug));
    $fractal = new Manager();
    $resource = self::renderRooms($query, $language);
    $response = $fractal->createData($resource)->toJson();
    $this->rooms->resetModel();
    $this->rooms->resetCriteria();
    return $response;
  }

  public function getLocations($include_status = false)
  {
    if ($include_status) {
      $this->location->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    $this->location->resetModel();
    $this->location->resetCriteria();
    return $this->location->all();
  }

  public function getAmenetiesByIds($ids = array(), $language = 'id')
  {
    $this->ameneties->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    $query = $this->ameneties->findWhereIn('id', $ids);
    $fractal = new Manager();
    $resource = new Collection($query, function(ModelAmeneties $model) use ($language) {
      return [
        'id' => (int) $model->id,
        'content' => $model->content[$language],
        'icon'  => $model->icon
      ];
    });
    $response = $fractal->createData($resource)->toJson();
    $this->ameneties->resetModel();
    $this->ameneties->resetCriteria();
    return $response;
  }

  public function getAmeneties($include_status = false)
  {
    if ($include_status) {
      $this->ameneties->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    }
    $this->ameneties->resetModel();
    $this->ameneties->resetCriteria();
    return $this->ameneties->all();
  }


  public function getRooms(Request $request, $limit = 4 ,$language = 'id')
  {
    $this->rooms->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    $data =  $this->rooms->scopeQuery(function($query) use($request) {
      if (!(bool)is_null($request->price)) {
        if ($request->price == 'high') {
          return $query->orderBy('price','desc');
        }
      }
      return $query->orderBy('price','asc');
    })->with(['location', 'type', 'owner'])->whereHas('location', function($query) use($request) {
      if (!(bool)is_null($request->location)) {
        return $query->where('slug', $request->location);
      }
      return $query;
    })->whereHas('owner', function($query){
      return $query->where('status', 1);
    })->paginate($limit);
    $query = $data->getCollection();
    $resource = self::renderRooms($query, $language);
    $resource->setPaginator(new IlluminatePaginatorAdapter($data));
    $fractal = new Manager();
    $response = $fractal->createData($resource)->toJson();
    $this->rooms->resetCriteria();
    return $response;
  }


  public function findByField($field, $value)
  {
    $this->rooms->pushCriteria(\Master\Rooms\Repositories\Criteria\LiveCriteria::class);
    $response = $this->rooms->findByField($field, $value)->first();
    $this->rooms->resetModel();
    $this->rooms->resetCriteria();
    return $response;
  }
}