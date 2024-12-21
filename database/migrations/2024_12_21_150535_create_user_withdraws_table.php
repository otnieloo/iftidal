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
    Schema::create('user_withdraws', function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id")->constrained("users", "id")->restrictOnDelete();
      $table->bigInteger("user_withdraw_status_id")->index();
      $table->string("withdraw_number");
      $table->dateTime("withdraw_time");
      $table->decimal("withdraw_amount", 10, 2);
      $table->text("information_bank")->nullable();
      $table->text("information_decline")->nullable();
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
    Schema::dropIfExists('user_withdraws');
  }
};
