<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\TypesRepositoryInterface;
use Master\Rooms\Models\Types;
use Validator;
use Meta;

class TypesResourceController extends Controller
{
  protected $repository;

  public function __construct(TypesRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
    Meta::title('Type');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Rooms\Repositories\Presenter\TypesPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('rooms::admin.types.index');  
  }

  public function create(Request $request)
  {
    $data = $this->repository->newInstance([]);
    return view('rooms::admin.types.form', compact('data'));
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
      'is_featured'=> $request->is_featured,
      'status'    => $request->status,
      'content'   => $request->content
    );


    $data = $this->repository->create($dataInsert);
    $request->session()->flash('status', 'Success Insert Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.types');
    }
    return redirect()->route('admin.types.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Types $data)
  {
    return view('rooms::admin.types.form', compact('data'));
  }

  public function update(Request $request, Types $data)
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
      'name'      => $request->name,
      'slug'      => $request->slug,
      'is_featured'=> $request->is_featured,
      'status'    => $request->status,
      'content'   => $request->content
    );

    $data = $this->repository->update($dataInsert, $data->id);
    $request->session()->flash('status', 'Success Update Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.types');
    }
    return redirect()->route('admin.types.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, Types $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.types');
  }

}