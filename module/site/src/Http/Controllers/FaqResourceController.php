<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Interfaces\FaqRepositoryInterface;
use Module\Site\Models\Faq;
use Validator;
use Meta;
use Module\Site\Interfaces\FaqCategoriesRepositoryInterface;
class FaqResourceController extends Controller
{
  protected $repository;
  protected $categories;

  public function __construct(
    FaqRepositoryInterface $repository,
    FaqCategoriesRepositoryInterface $categories
  )
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    $this->categories = $categories;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
    Meta::title('Faq');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Module\Site\Repositories\Presenter\FaqPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('site::admin.faq.index');  
  }

  public function create(Request $request)
  {
    $categories = self::getCategories();
    $data = $this->repository->newInstance([]);
    return view('site::admin.faq.form', compact('data', 'categories'));
  }


  protected function getCategories() {
    $data = $this->categories->all();
    $response[] = array();
    foreach ($data as $key => $list) {
      $response[] = array(
        'id' => $list->id,
        'text' =>  $list->name,
      );
    } 
    return $response;
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
      'name' => $request->name,
      'slug' => $request->slug,
      'faq_category_id'=> $request->faq_category_id,
      'title'=> $request->title,
      'description' => $request->description,
      'status'    => $request->status,
      'content'   => $request->content
    );


    $data = $this->repository->create($dataInsert);
    $request->session()->flash('status', 'Success Insert Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.faq');
    }
    return redirect()->route('admin.faq.edit', ['id' => $data->id]);
  }

  public function edit(Request $request, Faq $data)
  {
    $categories = self::getCategories();
    return view('site::admin.faq.form', compact('data', 'categories'));
  }

  public function update(Request $request, Faq $data)
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
      'name' => $request->name,
      'slug' => $request->slug,
      'faq_category_id'=> $request->faq_category_id,
      'title'=> $request->title,
      'description' => $request->description,
      'content' => $request->content,
      'status'  => $request->status,
    );

    $data = $this->repository->update($dataInsert, $data->id);
    $request->session()->flash('status', 'Success Update Data!');
    if ($request->submit == 'submit_exit') {
      return redirect()->route('admin.faq');
    }
    return redirect()->route('admin.faq.edit', ['id' => $data->id]);
  }

  public function delete(Request $request, Faq $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.faq');
  }

}