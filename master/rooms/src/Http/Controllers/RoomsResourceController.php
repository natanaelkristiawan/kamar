<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\RoomsRepositoryInterface;
use Master\Rooms\Models\Rooms;
use Validator;
use Meta;

class RoomsResourceController extends Controller
{
  protected $repository;

  public function __construct(RoomsRepositoryInterface $repository)
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

  public function create(Request $request)
  {
    $data = $this->repository->newInstance([]);
    return view('rooms::admin.rooms.form', compact('data'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name'      => 'required',
      'email'      => 'required',
      'phone'      => 'required',
      'status'    => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }

    $dataInsert = array(
      'name'    => $request->name,
      'email'    => $request->email,
      'phone'      => $request->phone,
      'photo'      => $request->photo,
      'status'    => $request->status,
      'content'   => $request->content
    );


    $data = $this->repository->create($dataInsert);

    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.rooms');
    }
    return redirect()->route('admin.rooms.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Rooms $data)
  {
    return view('rooms::admin.rooms.detail', compact('data'));
  }

  public function update(Request $request, Rooms $data)
  {
    $validator = Validator::make($request->all(), [
      'name'      => 'required',
      'email'      => 'required',
      'phone'      => 'required',
      'status'    => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
    }

    $dataInsert = array(
      'name'    => $request->name,
      'email'    => $request->email,
      'photo'      => $request->photo,
      'phone'      => $request->phone,
      'status'    => $request->status,
      'content'   => $request->content
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