<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqCategoryTable extends Migration
{
  public function up()
  {
    Schema::create('faq_categories', function (Blueprint $table) {
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
    Schema::drop('faq_categories');
  }
}
