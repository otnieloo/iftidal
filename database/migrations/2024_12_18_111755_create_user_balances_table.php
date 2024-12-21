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
    Schema::create('user_balances', function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id")->constrained("users", "id")->restrictOnDelete();
      $table->decimal("wallet", 10, 2)->default(0);
      $table->decimal("paid_deposit", 10, 2)->default(0);
      $table->decimal("pending_balance", 10, 2)->default(0);
      $table->decimal("credit_balance", 10, 2)->default(0);
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
    Schema::dropIfExists('user_balances');
  }
};
