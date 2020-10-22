<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PackagesUpdateTable extends Migration
{

	public function up()
	{
		Schema::table('packages', function (Blueprint $table) {
			$table->string('bitly')->nullable();
		});
	}

	public function down()
	{
		Schema::table('packages', function($table)
        {
            $table->dropColumn('bitly');
        });
	}
}
