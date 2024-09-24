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
    Schema::table('vendors', function (Blueprint $table) {
      $table->bigInteger("vendor_category_id")->after("vendor_status_id")->index()->nullable();
      $table->bigInteger("vendor_business_id")->after("vendor_category_id")->index()->nullable();
      $table->bigInteger("vendor_type_id")->after("vendor_business_id")->index()->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('vendors', function (Blueprint $table) {
      //
    });
  }
};
