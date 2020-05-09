<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\OwnersRepositoryInterface;
use Master\Rooms\Models\Owners;
use Validator;
use Meta;

class OwnersResourceController extends Controller
{
  protected $repository;

  public function __construct(OwnersRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
    Meta::title('Owners');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Rooms\Repositories\Presenter\OwnersPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('rooms::admin.owners.index');  
  }

  public function create(Request $request)
  {
    $data = $this->repository->newInstance([]);
    return view('rooms::admin.owners.form', compact('data'));
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
      return redirect()->route('admin.owners');
    }
    return redirect()->route('admin.owners.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Owners $data)
  {
    return view('rooms::admin.owners.detail', compact('data'));
  }

  public function update(Request $request, Owners $data)
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
      return redirect()->route('admin.owners');
    }
    return redirect()->route('admin.owners.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, Owners $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.owners');
  }

}