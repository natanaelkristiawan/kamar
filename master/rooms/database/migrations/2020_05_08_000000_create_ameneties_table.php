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
			$table->string('name');
			$table->string('slug');
			$table->text('content');
			$table->string('status');
			$table->softDeletes();
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::dropIfExists('ameneties');
	}
}