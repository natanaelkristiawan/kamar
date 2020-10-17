<?php

namespace Master\Packages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Packages\Interfaces\PackagesRepositoryInterface;
use Master\Packages\Models\Packages;
use Validator;
use Meta;

class PackagesResourceController extends Controller
{
	protected $repository;

	public function __construct(PackagesRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;

		Meta::title('Packages');
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