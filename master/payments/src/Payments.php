<?php
namespace Master\Payments;
use Midtrans\Snap;
use Midtrans\Config as MidtransConfig;

class Payments
{

	protected $midtrans;

	public function __construct()
	{
		MidtransConfig::$serverKey = env('MIDTRANS_SERVER_KEY');
		MidtransConfig::$isProduction = false;
		MidtransConfig::$isSanitized = true;
		MidtransConfig::$is3ds = true;
	}


	public function getSnapToken($params)
	{
		$snapToken = Snap::getSnapToken($params);

		return $snapToken;
	}
}