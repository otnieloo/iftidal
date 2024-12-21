<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_wallet_topups', function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id")->constrained("users", "id")->restrictOnDelete();
      $table->string("transaction_number");
      $table->dateTime("transaction_time");
      $table->decimal("amount", 10, 2);
      $table->tinyInteger("is_payment")->default(0);
      $table->string("pg_reference")->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_wallet_topups');
  }
};
