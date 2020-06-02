<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{

	public function up()
	{
		Schema::create('payment', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('finish_redirect_url')->nullable();
			$table->text('fraud_status')->nullable();
			$table->text('gross_amount')->nullable();
			$table->text('order_id')->nullable();
			$table->text('payment_type')->nullable();
			$table->text('pdf_url')->nullable();
			$table->text('status_code')->nullable();
			$table->text('status_message')->nullable();
			$table->text('transaction_id')->nullable();
			$table->text('transaction_status')->nullable();
			$table->text('transaction_time')->nullable();
			$table->text('details')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('payment');
	}
}