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
    Meta::title('Ameneties');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Articles\Repositories\Presenter\ArticlesPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }

    return view('rooms::admin.ameneties.index');  
  }

  public function create(Request $request)
  {

  }

  public function store(Request $request)
  {
   
  }

  public function edit(Request $request, Ameneties $data)
  {
    
  }

  public function update(Request $request, Ameneties $data)
  {
    
  }

  public function delete(Request $request, Ameneties $data)
  {

  }

}