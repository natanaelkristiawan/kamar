<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BooksTable extends Migration
{

	public function up()
	{
		Schema::create('books', function (Blueprint $table) {
		$table->increments('id');
		$table->string('name')->nullable();
		$table->string('slug')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('books');
	}
}
