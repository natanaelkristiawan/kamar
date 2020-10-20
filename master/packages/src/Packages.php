<?php
namespace Master\Packages;

use Master\Packages\Interfaces\PackagesRepositoryInterface as Repository;

class Packages
{

	public $packages;


	public function __construct(Repository $repository)
	{
		$this->packages = $repository;
	}

	public function getPackageByOwner($owner_id = 0)
	{
		$response = $this->packages->scopeQuery(function($query){
			return $query->where('date_start', '<=', date('Y-m-d'))
	    		->where('date_end', '>=', date('Y-m-d'));
		})->findWhere(array('owner_id' => $owner_id, 'status' => 1))->first();

	    $this->packages->resetModel();
    	$this->packages->resetCriteria();

    	return $response;
	}

}