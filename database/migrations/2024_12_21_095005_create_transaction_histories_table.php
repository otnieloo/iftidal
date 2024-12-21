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
    Schema::create('transaction_histories', function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id")->constrained("users", "id")->restrictOnDelete();
      $table->foreignId("transaction_history_status_id")->constrained("transaction_history_statuses", "id")->restrictOnDelete();
      $table->foreignId("transaction_history_type_id")->constrained("transaction_history_types", "id")->restrictOnDelete();
      $table->dateTime("transaction_time");
      $table->string("transaction_number");
      $table->text("description")->nullable();
      $table->decimal("amount", 10, 2);
      $table->bigInteger("reference_id")->index()->nullable();
      $table->string("route")->nullable();
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
    Schema::dropIfExists('transaction_histories');
  }
};
