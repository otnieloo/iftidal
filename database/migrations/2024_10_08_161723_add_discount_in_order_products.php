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
    Schema::table('order_products', function (Blueprint $table) {
      $table->decimal("product_discount_price")->after("total_capital_price")->default(0);
      $table->decimal("grand_total")->after("total_sell_price");
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('order_products', function (Blueprint $table) {
      //
    });
  }
};
