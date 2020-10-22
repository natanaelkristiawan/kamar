<?php

namespace Master\Packages\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Packages\Interfaces\CounterRepositoryInterface;
use Master\Packages\Models\Package;
use Validator;
use Meta;
use Master\Rooms\Facades\Rooms as Facade;
use Master\Rooms\Models\Rooms as ModelRoom;

class CounterResourceController extends Controller
{
	protected $repository;
	public function __construct(
		CounterRepositoryInterface $repository
	)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
		Meta::title('Counter');
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


	protected function getRooms()
	{
		$data = ModelRoom::all();
		$response[] = array();
		foreach ($data as $key => $list) {
		  $response[] = array(
		    'id' => $list->id,
		    'text' =>  $list->name
		  );
		} 
		return $response;
	}

	public function index(Request $request)
	{

		$owners = self::getOwners();
		$rooms = self::getRooms();

		if($request->ajax()){
			$pageLimit = $request->length;

			$data = $this->repository
			->setPresenter(\Master\Packages\Repositories\Presenter\CounterPresenter::class)
			->setPageLimit($pageLimit)
			->getDataTable();

			return response()->json($data);
		}

		return view('packages::admin.counter.index', compact('owners', 'rooms'));  
	}

}