<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomDateOffTable extends Migration
{

  public function up()
  {
    Schema::create('room_date_off', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('room_id')->nullable();
      $table->date('date')->nullable();
      $table->timestamps();
    });
  }


  public function down()
  {
    Schema::dropIfExists('room_date_off');
  }
}