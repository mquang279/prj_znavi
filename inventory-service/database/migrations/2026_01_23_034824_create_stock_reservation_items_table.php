<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_reservation_items', function (Blueprint $table) {
            $table->integer("reservation_id");
            $table->integer("product_id");
            $table->integer("qty");

            $table->foreign("reservation_id")
                ->references("id")
                ->on("stock_reservations")
                ->cascadeOnDelete();

            $table->foreign("product_id")
                ->references("id")
                ->on("products")
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_reservation_items');
    }
};
