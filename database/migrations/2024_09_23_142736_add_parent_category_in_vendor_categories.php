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
    Schema::table('vendor_categories', function (Blueprint $table) {
      $table->bigInteger("parent_category_id")->after("id")->nullable()->index();
      $table->bigInteger("parent_category")->after("parent_category_id")->nullable();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('vendor_categories', function (Blueprint $table) {
      //
    });
  }
};
