<?php

namespace Master\Packages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Packages\Interfaces\PackagesRepositoryInterface;
use Master\Packages\Models\Packages;
use Validator;
use Meta;
use Master\Rooms\Facades\Rooms as Facade;

class PackagesResourceController extends Controller
{
	protected $repository;
	public function __construct(
		PackagesRepositoryInterface $repository
	)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;

		Meta::title('Packages');
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

	public function index(Request $request)
	{
		if($request->ajax()){
			$pageLimit = $request->length;

			$data = $this->repository
			->setPresenter(\Master\Customers\Repositories\Presenter\CustomersPresenter::class)
			->setPageLimit($pageLimit)
			->getDataTable();

			return response()->json($data);
		}

		return view('packages::admin.packages.index');  
	}

	public function create(Request $request)
	{
		$owners = self::getOwners();
		$data = $this->repository->newInstance([]);
		return view('packages::admin.packages.form', compact('owners', 'data'));

	}

	public function store(Request $request)
	{
	 
	}

	public function edit(Request $request, Packages $data)
	{
	  
	}

	public function update(Request $request, Packages $data)
	{
	  
	}

	public function delete(Request $request, Packages $data)
	{

	}

}