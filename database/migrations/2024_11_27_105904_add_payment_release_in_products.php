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
    Schema::table('products', function (Blueprint $table) {
      $table->bigInteger("payment_release_id")->after("product_level_id")->index()->nullable();
      $table->string("payment_release")->after("payment_release_id")->nullable();

      $table->bigInteger("product_guarantee_id")->after("payment_release")->index()->nullable();
      $table->string("product_guarantee")->after("product_guarantee_id")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('products', function (Blueprint $table) {
      //
    });
  }
};
