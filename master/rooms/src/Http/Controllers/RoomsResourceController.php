<?php

namespace Master\Rooms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Rooms\Interfaces\RoomsRepositoryInterface;
use Master\Rooms\Models\Rooms;
use Validator;

class RoomsResourceController extends Controller
{
	protected $repository;

	public function __construct(RoomsRepositoryInterface $repository)
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

	public function edit(Request $request, Rooms $data)
	{
	  
	}

	public function update(Request $request, Rooms $data)
	{
	  
	}

	public function delete(Request $request, Rooms $data)
	{

	}

}