<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{

  public function up()
  {
    Schema::create('books', function (Blueprint $table) {
      $table->increments('id');
      $table->text('uuid')->nullable();
      $table->integer('customer_id')->nullable();
      $table->integer('room_id')->nullable();
      $table->integer('payment_id')->nullable();
      $table->integer('review_id')->nullable();
      $table->integer('rooms')->nullable();
      $table->integer('guests')->nullable();
      $table->integer('nights')->nullable();
      $table->integer('price')->nullable();
      $table->integer('total')->nullable();
      $table->integer('service')->nullable();
      $table->integer('grand_total')->nullable();
      $table->date('date_checkin')->nullable();
      $table->date('date_checkout')->nullable();
      $table->text('notes')->nullable();
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
