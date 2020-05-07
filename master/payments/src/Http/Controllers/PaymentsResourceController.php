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
	}

	public function index(Request $request)
	{

	}

	public function create(Request $request)
	{

	}

	public function store(Request $request)
	{
	 
	}

	public function edit(Request $request, Payments $data)
	{
	  
	}

	public function update(Request $request, Payments $data)
	{
	  
	}

	public function delete(Request $request, Payments $data)
	{

	}

}