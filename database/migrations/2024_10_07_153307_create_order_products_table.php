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
    Schema::create('order_products', function (Blueprint $table) {
      $table->id();
      $table->foreignId("order_id")->constrained("orders", "id")->restrictOnDelete();
      $table->foreignId("user_id")->constrained("users", "id")->restrictOnDelete();
      $table->foreignId("vendor_id")->constrained("vendors", "id")->restrictOnDelete();
      $table->foreignId("product_id")->constrained("products", "id")->restrictOnDelete();
      $table->foreignId("product_variation_id")->constrained("product_variations")->restrictOnDelete();
      $table->foreignId("product_category_id")->constrained("product_categories", "id")->restrictOnDelete();
      $table->string("product_name");
      $table->bigInteger("qty");
      $table->bigInteger("product_capital_price");
      $table->bigInteger("total_capital_price");
      $table->bigInteger("product_sell_price");
      $table->bigInteger("total_sell_price");
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
    Schema::dropIfExists('order_products');
  }
};
