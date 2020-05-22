<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{

  public function up()
  {
    Schema::create('rooms', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->text('meta')->nullable();
      $table->string('name')->nullable();
      $table->string('slug')->nullable();
      $table->integer('location_id')->nullable();
      $table->integer('owner_id')->nullable();
      $table->integer('type_id')->nullable();
      $table->text('address')->nullable();
      $table->text('address_detail')->nullable();
      $table->string('latitude')->nullable();
      $table->string('longitude')->nullable();
      $table->text('photo_primary')->nullable();
      $table->text('gallery')->nullable();
      $table->string('youtube')->nullable();
      $table->text('ameneties_ids')->nullable();
      $table->text('title')->nullable();
      $table->text('abstract')->nullable();
      $table->text('description')->nullable();
      $table->text('house_rules')->nullable();
      $table->text('price')->nullable();
      $table->text('date_off')->nullable();
      $table->integer('total_room')->nullable();
      $table->tinyInteger('is_featured')->nullable();
      $table->tinyinteger('status')->default(0);
      $table->softDeletes();
      $table->timestamps();
    });
  }


  public function down()
  {
    Schema::dropIfExists('rooms');
  }
}