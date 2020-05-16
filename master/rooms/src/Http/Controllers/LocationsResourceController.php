<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\LocationsRepositoryInterface;
use Master\Rooms\Models\Locations;
use Validator;
use Meta;

class LocationsResourceController extends Controller
{
  protected $repository;

  public function __construct(LocationsRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
    Meta::title('Locations');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Rooms\Repositories\Presenter\LocationsPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('rooms::admin.locations.index');  
  }

  public function create(Request $request)
  {
    $data = $this->repository->newInstance([]);
    return view('rooms::admin.locations.form', compact('data'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name'      => 'required',
      'slug'      => 'required',
      'status'    => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }

    $dataInsert = array(
      'name'    => $request->name,
      'slug'      => $request->slug,
      'status'    => $request->status,
    );


    $data = $this->repository->create($dataInsert);
    $request->session()->flash('status', 'Success Insert Data!');
    
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.locations');
    }
    return redirect()->route('admin.locations.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Locations $data)
  {
    return view('rooms::admin.locations.form', compact('data'));
  }

  public function update(Request $request, Locations $data)
  {
    $validator = Validator::make($request->all(), [
      'name'      => 'required',
      'slug'      => 'required',
      'status'    => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }

    $dataInsert = array(
      'name'    => $request->name,
      'slug'      => $request->slug,
      'status'    => $request->status,
    );

    $data = $this->repository->update($dataInsert, $data->id);
    $request->session()->flash('status', 'Success Update Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.locations');
    }
    return redirect()->route('admin.locations.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, Locations $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.locations');
  }

}