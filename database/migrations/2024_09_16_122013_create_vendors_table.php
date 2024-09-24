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
    Schema::create('vendors', function (Blueprint $table) {
      $table->id();
      $table->foreignId('vendor_status_id')->constrained('vendor_statuses')->cascadeOnDelete();
      $table->string('company_name');
      $table->string('company_phone', 20);
      $table->string('company_email');
      $table->text('company_address');
      $table->string('logo')->nullable();
      $table->string('contact_person_name');
      $table->string('contact_person_phone');
      $table->string('contact_person_email');
      $table->string('longitude')->nullable();
      $table->string('latitude')->nullable();
      $table->string('coordinates')->nullable();
      $table->date('register_date')->default(date('Y-m-d'));
      $table->date('approved_date')->nullable();
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
    Schema::dropIfExists('vendors');
  }
};
