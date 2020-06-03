<?php
namespace Master\Payments;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;
use Master\Payments\Interfaces\PaymentsRepositoryInterface;
class Payments
{

	protected $midtrans;
	protected $payments;

	public function __construct(
		PaymentsRepositoryInterface $payments
	)
	{
		MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
		MidtransConfig::$isProduction = false;
		MidtransConfig::$isSanitized = true;
		MidtransConfig::$is3ds = true;

		$this->payments = $payments;
	}
	
	public function getSnapToken($params)
	{
		$snapToken = Snap::getSnapToken($params);
		return $snapToken;
	}

	public function createHistoryPayment($params)
	{
		$query = $this->payments->create($params);
		$this->payments->resetModel();
		return $query;
	}
}