<?php

namespace Master\Books\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Books\Interfaces\BooksRepositoryInterface;
use Master\Books\Models\Books;
use Validator;

class BooksResourceController extends Controller
{
	protected $repository;

	public function __construct(BooksRepositoryInterface $repository)
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

	public function edit(Request $request, Books $data)
	{
	  
	}

	public function update(Request $request, Books $data)
	{
	  
	}

	public function delete(Request $request, Books $data)
	{

	}

}