<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PackagesTable extends Migration
{

	public function up()
	{
		Schema::create('packages', function (Blueprint $table) {
		$table->increments('id');
		$table->integer('owner_id')->nullable();
		$table->integer('total_quota')->nullable()->default(0);
		$table->integer('used_quota')->nullable()->default(0);
		$table->integer('remaining_quota')->nullable()->default(0);
		$table->date('date_start')->nullable();
		$table->date('date_end')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('packages');
	}
}
