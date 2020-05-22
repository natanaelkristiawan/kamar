
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{

  public function up()
  {
    Schema::create('owners', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('name')->nullable();
      $table->string('email')->nullable();
      $table->string('phone')->nullable();
      $table->text('photo')->nullable();
      $table->text('card_id')->nullable();
      $table->text('selfie_with_card_id')->nullable();
      $table->string('bank')->nullable();
      $table->string('bank_code')->nullable();
      $table->string('bank_account')->nullable();
      $table->text('bank_account_photo')->nullable();
      $table->tinyinteger('status')->default(0);
      $table->softDeletes();
      $table->timestamps();
    });
  }


  public function down()
  {
    Schema::dropIfExists('owners');
  }
}