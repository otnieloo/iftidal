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
    Schema::create('guests', function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id")->constrained("users", "id")->restrictOnDelete();
      $table->foreignId("order_id")->constrained("orders", "id")->restrictOnDelete();
      $table->foreignId("guest_group_id")->constrained("guest_groups", "id")->restrictOnDelete();
      $table->foreignId("guest_status_id")->constrained("guest_statuses", "id")->restrictOnDelete();

      $table->string("name");
      $table->bigInteger("country_code_id")->index();
      $table->string("phone_number", 50);
      $table->string("origin");
      $table->date("confirmation_date")->nullable();
      $table->time("eta")->nullable();
      $table->integer("number_pax")->default(1);
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
    Schema::dropIfExists('guests');
  }
};
