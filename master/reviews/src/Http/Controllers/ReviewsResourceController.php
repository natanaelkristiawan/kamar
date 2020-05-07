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

	public function edit(Request $request, Reviews $data)
	{
	  
	}

	public function update(Request $request, Reviews $data)
	{
	  
	}

	public function delete(Request $request, Reviews $data)
	{

	}

}