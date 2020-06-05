<?php

namespace Master\Payments\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Payments\Interfaces\PaymentsRepositoryInterface;
use Master\Payments\Models\Payments;
use Validator;

class PaymentsResourceController extends Controller
{
	protected $repository;

	public function __construct(PaymentsRepositoryInterface $repository)
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
					->pushCriteria(\Master\Payments\Repositories\Criteria\PaymentsCriteria::class)
          ->setPresenter(\Master\Payments\Repositories\Presenter\PaymentsPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();
      return response()->json($data);
    }


		return view('payments::admin.payments.index');  
	}
}