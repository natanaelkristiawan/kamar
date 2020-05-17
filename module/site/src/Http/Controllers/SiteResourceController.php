<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Interfaces\SiteRepositoryInterface;
use Module\Site\Models\Site;
use Validator;

class SiteResourceController extends Controller
{
	protected $repository;

	public function __construct(SiteRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
	}

	public function index(Request $request)
	{
		return view('site::admin.site.index');
	}

	public function create(Request $request)
	{

	}

	public function store(Request $request)
	{
	 
	}

	public function edit(Request $request, Site $data)
	{
	  
	}

	public function update(Request $request, Site $data)
	{
	  
	}

	public function delete(Request $request, Site $data)
	{

	}

}