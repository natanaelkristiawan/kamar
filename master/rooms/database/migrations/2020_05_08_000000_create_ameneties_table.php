<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenetiesTable extends Migration
{

	public function up()
	{
		Schema::create('ameneties', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->text('icon')->nullable();
			$table->text('content')->nullable();
			$table->tinyinteger('status')->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('ameneties');
	}
}