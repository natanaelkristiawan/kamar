<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{

	public function up()
	{
		Schema::create('reviews', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->integer('book_id')->nullable();
			$table->integer('room_id')->nullable();
			$table->integer('customer_id')->nullable();
			$table->integer('rating')->nullable();
			$table->text('review')->nullable();
			$table->tinyInteger('status')->default(0)->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('reviews');
	}
}