<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{

  public function up()
  {
    Schema::create('book_histories', function (Blueprint $table) {
    $table->increments('id');
    $table->text('uuid')->nullable();
    $table->text('data')->nullable();
    $table->timestamps();
    });
  }
  public function down()
  {
    Schema::drop('book_histories');
  }
}
