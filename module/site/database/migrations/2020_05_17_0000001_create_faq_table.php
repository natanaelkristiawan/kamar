<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqTable extends Migration
{
  public function up()
  {
    Schema::create('faq', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('faq_category_id');
    $table->string('name')->nullable();
    $table->string('slug')->nullable();
    $table->text('title')->nullable();
    $table->text('description')->nullable();
    $table->tinyinteger('status')->default(0);
    $table->timestamps();
    $table->softDeletes();
    });
  }

  public function down()
  {
    Schema::drop('faq');
  }
}
