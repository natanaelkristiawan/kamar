<?php

namespace Master\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Customers\Interfaces\CustomersRepositoryInterface;
use Master\Customers\Models\Customers;
use Validator;

class CustomersResourceController extends Controller
{
	protected $repository;

	public function __construct(CustomersRepositoryInterface $repository)
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

	public function edit(Request $request, Customers $data)
	{
	  
	}

	public function update(Request $request, Customers $data)
	{
	  
	}

	public function delete(Request $request, Customers $data)
	{

	}

}