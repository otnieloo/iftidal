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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->foreignId('vendor_id')->nullable()->constrained('vendors')->cascadeOnDelete();
      $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->cascadeOnDelete();
      $table->bigInteger('product_subcategory_id')->index();
      $table->foreignId('product_status_id')->nullable()->constrained('product_statuses')->cascadeOnDelete();
      $table->foreignId('product_condition_id')->nullable()->constrained('product_conditions')->cascadeOnDelete();
      $table->foreignId('product_level_id')->nullable()->constrained('product_levels')->cascadeOnDelete();
      $table->smallInteger('product_service');
      $table->string('product_name');
      $table->text('product_description');
      $table->string('product_unit');
      $table->string('product_sku');
      $table->integer('product_stock')->nullable();
      $table->integer('product_slot');
      $table->decimal('product_capital_price', 10, 2);
      $table->decimal('product_sell_price', 10, 2);
      $table->string('product_image')->nullable();
      $table->string('product_video')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
};
