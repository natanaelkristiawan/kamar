<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\RoomsRepositoryInterface;
use Master\Rooms\Models\Rooms;
use Validator;
use Meta;
use Master\Rooms\Facades\Rooms as Facade;
class RoomsResourceController extends Controller
{
  protected $repository;
  protected $owners;
  protected $facade;
  public function __construct(
    RoomsRepositoryInterface $repository
  )
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);

    Meta::title('Rooms');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
     
    }

    return view('rooms::admin.rooms.index');  
  }


  protected function getOwners()
  {
    $data = Facade::getOwners();
    $response[] = array();
    foreach ($data as $key => $list) {
      $response[] = array(
        'id' => $list->id,
        'text' =>  $list->name.' - '.$list->phone,
        'phone' => $list->phone
      );
    } 
    return $response;
  }

  protected function getTypes()
  {
    $data = Facade::getTypes();

    $response[] = array();
    foreach ($data as $key => $list) {
      $response[] = array(
        'id' => $list->id,
        'text' => $list->name,
      );
    } 
    return $response;
  }

  protected function getLocations()
  {
    $data = Facade::getLocations();


    $response[] = array();
    foreach ($data as $key => $list) {
      $response[] = array(
        'id' => $list->id,
        'text' => $list->name,
      );
    } 
    return $response;
  }

  public function getAmeneties()
  {
    $data = Facade::getAmeneties();
    $response = array();
    foreach ($data as $key => $list) {
      $response[] = array(
        'value' => $list->id,
        'text'  => $list->name,
        'index' => $key
      );
    } 
    return $response;
  }

  public function create(Request $request)
  {
    $owners = self::getOwners();
    $types = self::getTypes();
    $locations = self::getLocations();
    $ameneties = self::getAmeneties();
    $data = $this->repository->newInstance([]);
    return view('rooms::admin.rooms.form', compact('data', 'owners', 'types', 'locations', 'ameneties'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name'    => 'required',
      'slug'    => 'required',
      'owner_id'=> 'required',
      'type_id' => 'required',
      'total_room' => 'required',
      'price' => 'required'
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }
    // nnti di cek disini
    $dataInsert = array(
      'name' => $request->name,
      'slug' => $request->slug,
      'owner_id' => $request->owner_id,
      'type_id' => $request->type_id,
      'is_featured' => $request->is_featured,
      'status' => $request->status,
      'meta' => is_null($request->meta) ? array() : $request->meta,
      'title' => is_null($request->title) ? array() : $request->title,
      'abstract' => is_null($request->abstract) ? array() : $request->abstract,
      'description' => is_null($request->description) ? array() : $request->description,
      'house_rules' => is_null($request->house_rules) ? array() : $request->house_rules,
      'date_off' => is_null($request->date_off) ? array() : $request->date_off,
      'total_room' => $request->total_room,
      'price' => $request->price,
      'latitude' => $request->latitude,
      'longitude' => $request->longitude,
      'location_id' => $request->location_id,
      'address' => $request->address,
      'address_detail' => $request->address_detail,
      'ameneties_ids' => is_null($request->ameneties_ids) ? array() : array_values($request->ameneties_ids),
      'photo_primary' => $request->photo_primary,
      'gallery' => is_null($request->gallery) ? array() : array_values($request->gallery),
      'youtube' => $request->youtube,
    );


    $data = $this->repository->create($dataInsert);

    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.rooms');
    }
    return redirect()->route('admin.rooms.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Rooms $data)
  {
    $owners = self::getOwners();
    $types = self::getTypes();
    $locations = self::getLocations();
    $ameneties = self::getAmeneties();
    return view('rooms::admin.rooms.form', compact('data', 'owners', 'types', 'locations', 'ameneties'));
  }

  public function update(Request $request, Rooms $data)
  {
    $validator = Validator::make($request->all(), [
      'name'    => 'required',
      'slug'    => 'required',
      'owner_id'=> 'required',
      'type_id' => 'required',
      'total_room' => 'required',
      'price' => 'required'
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }

     $dataInsert = array(
      'name' => $request->name,
      'slug' => $request->slug,
      'owner_id' => $request->owner_id,
      'type_id' => $request->type_id,
      'is_featured' => $request->is_featured,
      'status' => $request->status,
      'meta' => is_null($request->meta) ? array() : $request->meta,
      'title' => is_null($request->title) ? array() : $request->title,
      'abstract' => is_null($request->abstract) ? array() : $request->abstract,
      'description' => is_null($request->description) ? array() : $request->description,
      'house_rules' => is_null($request->house_rules) ? array() : $request->house_rules,
      'date_off' => is_null($request->date_off) ? array() : $request->date_off,
      'total_room' => $request->total_room,
      'price' => $request->price,
      'latitude' => $request->latitude,
      'longitude' => $request->longitude,
      'location_id' => $request->location_id,
      'address' => $request->address,
      'address_detail' => $request->address_detail,
      'ameneties_ids' => is_null($request->ameneties_ids) ? array() : array_values($request->ameneties_ids),
      'photo_primary' => $request->photo_primary,
      'gallery' => is_null($request->gallery) ? array() : array_values($request->gallery),
      'youtube' => $request->youtube,
    );


    $data = $this->repository->update($dataInsert, $data->id);

    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.rooms');
    }
    return redirect()->route('admin.rooms.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, Rooms $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.rooms');
  }

}