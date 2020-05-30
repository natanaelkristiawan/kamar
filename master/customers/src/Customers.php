<?php
namespace Master\Customers;
use Master\Customers\Interfaces\CustomersRepositoryInterface;


class Customers
{
	protected $customer;
	public function __construct(
 		CustomersRepositoryInterface $customer
	)
	{
		$this->customer = $customer;
	}

	public function findByEmail($email = '')
	{
		$query = $this->customer->findByField('email', $email)->first();
		$this->customer->resetModel();
		return $query;
	}

	public function findByTokenActivate($token = '')
	{
		$query = $this->customer->findByField('token_verified', $token)->first();
		$this->customer->resetModel();
		return $query;
	}


	public function createCustomer($params)
	{
		$query = $this->customer->create($params);
		$this->customer->resetModel();
		return $query;
	}


}