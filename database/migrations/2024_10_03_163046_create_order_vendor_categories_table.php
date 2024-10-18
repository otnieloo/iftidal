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
    Schema::create('order_vendor_categories', function (Blueprint $table) {
      $table->id();
      $table->foreignId("order_id")->constrained("orders", "id")->restrictOnDelete();
      $table->foreignId("vendor_category_id")->constrained("vendor_categories", "id")->restrictOnDelete();
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
    Schema::dropIfExists('order_vendor_categories');
  }
};
