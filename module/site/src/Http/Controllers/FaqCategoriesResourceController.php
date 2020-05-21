<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Interfaces\FaqCategoriesRepositoryInterface;
use Module\Site\Models\FaqCategories;
use Validator;
use Meta;
class FaqCategoriesResourceController extends Controller
{
  protected $repository;

  public function __construct(FaqCategoriesRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
    Meta::title('Faq Categories');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Module\Site\Repositories\Presenter\FaqCategoriesPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('site::admin.faqcategories.index');  
  }

  public function create(Request $request)
  {
    $data = $this->repository->newInstance([]);
    return view('site::admin.faqcategories.form', compact('data'));
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
      'content'   => $request->content
    );


    $data = $this->repository->create($dataInsert);
    $request->session()->flash('status', 'Success Insert Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.faqcategories');
    }
    return redirect()->route('admin.faqcategories.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, FaqCategories $data)
  {
    return view('site::admin.faqcategories.form', compact('data'));
  }

  public function update(Request $request, FaqCategories $data)
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
      'status'    => $request->status,
    );

    $data = $this->repository->update($dataInsert, $data->id);
    $request->session()->flash('status', 'Success Update Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.faqcategories');
    }
    return redirect()->route('admin.faqcategories.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, FaqCategories $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.faqcategories');
  }

}