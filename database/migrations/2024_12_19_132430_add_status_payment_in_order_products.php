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
      $table->bigInteger("payment_vendor_status_id")->after("is_choice")->index();
      $table->decimal("payment_vendor_amount", 10, 2)->after("payment_vendor_status_id")->default(0);
      $table->decimal("payment_vendor_available", 10, 2)->after("payment_vendor_amount")->default(0);
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
