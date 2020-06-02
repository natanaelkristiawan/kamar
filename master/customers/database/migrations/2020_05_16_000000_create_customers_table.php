<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{

  public function up()
  {
    Schema::create('customers', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name')->nullable();
    $table->string('email')->nullable();
    $table->string('password')->nullable();
    $table->string('gender')->nullable();
    $table->date('dob')->nullable();
    $table->string('phone')->nullable();
    $table->string('photo')->nullable();
    $table->string('facebook_id')->nullable();
    $table->string('google_id')->nullable();
    $table->string('remember_token')->nullable();
    $table->string('token_forgot_password')->nullable();
    $table->string('token_verified')->nullable();
    $table->datetime('verified_at')->nullable();
    $table->tinyinteger('status')->default(0);
    $table->timestamps();
    $table->softDeletes();
    });
  }
  public function down()
  {
    Schema::drop('customers');
  }
}
