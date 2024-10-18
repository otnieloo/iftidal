<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId("user_id")->constrained("users", "id")->restrictOnDelete();
            $table->foreignId("event_type_id")->constrained("event_types", "id")->restrictOnDelete();
            $table->foreignId("order_status_id")->constrained("order_statuses", "id")->restrictOnDelete();
            $table->foreignId("payment_status_id")->constrained("payment_statuses", "id")->restrictOnDelete();

            $table->date("event_date");
            $table->time("event_start_time");
            $table->time("event_end_time");

            $table->foreignId("location_id")->constrained("locations", "id")->restrictOnDelete();
            $table->string("longitude")->nullable();
            $table->string("latitude")->nullable();
            $table->text("full_address")->nullable();

            $table->bigInteger("event_guest_count")->default(0);
            $table->decimal("event_start_budget", 10, 2)->default(0);
            $table->decimal("event_end_budget", 10, 2)->default(0);
            
            $table->decimal("total_price_capital", 10, 2)->default(0);
            $table->decimal("total_price_sell", 10, 2)->default(0);
            $table->decimal("tax_percent", 10, 2)->default(0);
            $table->decimal("total_tax", 10, 2)->default(0);
            $table->decimal("total_discount", 10, 2)->default(0);
            $table->decimal("grand_total", 10, 2)->default(0);

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
        Schema::dropIfExists('orders');
    }
};
