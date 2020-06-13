<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookmarkTable extends Migration
{

	public function up()
	{
		Schema::create('bookmark', function (Blueprint $table) {
		$table->increments('id');
		$table->integer('customer_id')->nullable();
		$table->integer('room_id')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('bookmark');
	}
}
