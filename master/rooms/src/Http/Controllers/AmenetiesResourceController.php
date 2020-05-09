<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\AmenetiesRepositoryInterface;
use Master\Rooms\Models\Ameneties;
use Validator;
use Meta;

class AmenetiesResourceController extends Controller
{
  protected $repository;

  public function __construct(AmenetiesRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
    Meta::title('Ameneties');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Rooms\Repositories\Presenter\AmenetiesPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('rooms::admin.ameneties.index');  
  }

  public function create(Request $request)
  {
    $data = $this->repository->newInstance([]);
    return view('rooms::admin.ameneties.form', compact('data'));
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
      'icon'    => $request->icon,
      'status'    => $request->status,
      'content'   => $request->content
    );


    $data = $this->repository->create($dataInsert);

    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.ameneties');
    }
    return redirect()->route('admin.ameneties.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Ameneties $data)
  {
    return view('rooms::admin.ameneties.form', compact('data'));
  }

  public function update(Request $request, Ameneties $data)
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
      'content'   => $request->content,
      'icon'    => $request->icon,
      'status'    => $request->status,
    );

    $data = $this->repository->update($dataInsert, $data->id);

    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.ameneties');
    }
    return redirect()->route('admin.ameneties.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, Ameneties $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.ameneties');
  }

}