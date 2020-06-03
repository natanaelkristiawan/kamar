<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{

	public function up()
	{
		Schema::create('payments', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('order_id')->nullable();
			$table->text('status_code')->nullable();
			$table->text('status_message')->nullable();
			$table->text('transaction_id')->nullable();
			$table->text('transaction_status')->nullable();
			$table->text('details')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('payments');
	}
}