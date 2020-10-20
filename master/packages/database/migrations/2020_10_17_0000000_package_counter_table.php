<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PackageCounterTable extends Migration
{

	public function up()
	{
		Schema::create('package_counter', function (Blueprint $table) {
		$table->increments('id');
		$table->integer('package_id')->nullable();
		$table->text('dataIPClient')->nullable();
		$table->string('ip')->nullable();
		$table->string('fingerprint')->nullable();
		$table->integer('owner_id')->nullable();
		$table->integer('room_id')->nullable();
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('package_counter');
	}
}
