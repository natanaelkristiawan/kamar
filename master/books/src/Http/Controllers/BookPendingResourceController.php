<?php

namespace Master\Books\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Books\Interfaces\BooksRepositoryInterface;
use Master\Books\Models\Books;
use Validator;
use Payments;

class BookPendingResourceController extends Controller
{
	protected $repository;

	public function __construct(BooksRepositoryInterface $repository)
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
					->pushCriteria(\Master\Books\Repositories\Criteria\BookPendingCriteria::class)
          ->setPresenter(\Master\Books\Repositories\Presenter\BookPendingPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
		return view('books::admin.pending.index');  
	}

	public function cancelBooking(Request $request, $order_id = '')
	{
		$response = Payments::cancelPayment($order_id);
		if ($response) {
			$request->session()->flash('status', 'Success Delete Order!');
			return redirect()->route('admin.bookPending');
		}
	}
}