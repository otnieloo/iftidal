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
    Schema::create('order_vendors', function (Blueprint $table) {
      $table->id();
      $table->foreignId('order_id')->constrained("orders", "id")->restrictOnDelete();
      $table->foreignId('vendor_id')->constrained("vendors", "id")->restrictOnDelete();
      $table->foreignId('order_vendor_status_id')->constrained("order_vendor_statuses", "id")->restrictOnDelete();
      $table->integer("progress")->default(0);
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
    Schema::dropIfExists('order_vendors');
  }
};
