<?php

namespace Master\Packages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Packages\Interfaces\PackagesRepositoryInterface;
use Master\Packages\Models\Package;
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
		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
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
		$owners = self::getOwners();

		if($request->ajax()){
			$pageLimit = $request->length;

			$data = $this->repository
			->setPresenter(\Master\Packages\Repositories\Presenter\PackagesPresenter::class)
			->setPageLimit($pageLimit)
			->getDataTable();

			return response()->json($data);
		}

		return view('packages::admin.packages.index', compact('owners'));  
	}

	public function create(Request $request)
	{
		$owners = self::getOwners();
		$data = $this->repository->newInstance([]);
		return view('packages::admin.packages.form', compact('owners', 'data'));

	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'owner_id' => 'required',
			'total_quota' => 'required',
			'used_quota' => 'required',
			'remaining_quota' => 'required',
			'date_start' => 'required',
			'date_end' => 'required',
	    ]);

	    if ($validator->fails()) {
	      return redirect()->back()
	                    ->withErrors($validator)
	                    ->withInput();
	    }


	    $dataInsert = array(
	    	'owner_id' => $request->owner_id,
			'total_quota' => $request->total_quota,
			'used_quota' => $request->used_quota,
			'remaining_quota' => $request->remaining_quota,
			'date_start' => $request->date_start,
			'date_end' => $request->date_end,
			'bitly' => $request->bitly,
			'status' => 1,
	    );

	    $data = $this->repository->create($dataInsert);

	    $request->session()->flash('status', 'Success Insert Data!');

	    if ($request->submit == 'submit_exit') {
	      return redirect()->route('admin.packages');
	    }
	    return redirect()->route('admin.packages.edit', ['id' => $data->id]);
	}

	public function edit(Request $request, Package $data)
	{
		$owners = self::getOwners();
		return view('packages::admin.packages.form', compact('owners', 'data')); 
	}

	public function update(Request $request, Package $data)
	{
	  $validator = Validator::make($request->all(), [
			'owner_id' => 'required',
			'total_quota' => 'required',
			'used_quota' => 'required',
			'remaining_quota' => 'required',
			'date_start' => 'required',
			'date_end' => 'required',
	    ]);

	    if ($validator->fails()) {
	      return redirect()->back()
	                    ->withErrors($validator)
	                    ->withInput();
	    }


	    $dataInsert = array(
	    	'owner_id' => $request->owner_id,
			'total_quota' => $request->total_quota,
			'used_quota' => $request->used_quota,
			'remaining_quota' => $request->remaining_quota,
			'date_start' => $request->date_start,
			'date_end' => $request->date_end,
			'bitly' => $request->bitly,
	    );


	    if ($request->used_quota <  $request->total_quota) {
	    	$dataInsert['status'] = 1;
	    } else {
	    	$dataInsert['status'] = 3;
	    }

	    $data = $this->repository->update($dataInsert, $data->id);

	    $request->session()->flash('status', 'Success Insert Data!');

	    if ($request->submit == 'submit_exit') {
	      return redirect()->route('admin.packages');
	    }
	    return redirect()->route('admin.packages.edit', ['id' => $data->id]);
	}

	public function delete(Request $request, Package $data)
	{
	   	$data = $this->repository->delete($data->id);
		$request->session()->flash('status', 'Success Delete Data!');

		return redirect()->route('admin.packages');
	}

}