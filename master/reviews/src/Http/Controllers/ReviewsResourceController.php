<?php

namespace Master\Reviews\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Reviews\Interfaces\ReviewsRepositoryInterface;
use Master\Reviews\Models\Reviews;
use Validator;

class ReviewsResourceController extends Controller
{
	protected $repository;

	public function __construct(ReviewsRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
	}

	public function index(Request $request)
	{
		if($request->ajax()){
      $pageLimit = $request->length;
      $data = $this->repository
      		->customFilters($request)
          ->setPresenter(\Master\Reviews\Repositories\Presenter\ReviewsPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
		

		return view('reviews::admin.reviews.index');
	}

	public function create(Request $request)
	{
		$data = $this->repository->newInstance([]);
		return view('reviews::admin.reviews.form', compact('data'));
	}


	public function confirm(Request $request, Reviews $data)
	{
	  $dataUpdate = array(
	  	'status' => 1
	  );

	  $this->repository->update($dataUpdate, $data->id);
	  $request->session()->flash('status', 'Success Update Data!');
	  return redirect()->route('admin.reviews');
	}

	public function decline(Request $request, Reviews $data)
	{
		 $dataUpdate = array(
	  	'status' => 0
	  );

	  $this->repository->update($dataUpdate, $data->id);
	  $request->session()->flash('status', 'Success Update Data!');
	  return redirect()->route('admin.reviews');
	}

	public function delete(Request $request, Reviews $data)
	{
		$data = $this->repository->delete($data->id);
		$request->session()->flash('status', 'Success Delete Data!');

		return redirect()->route('admin.reviews');
	}

}