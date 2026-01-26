<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_reservations', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("request_id")->unique();
            $table->uuid("bill_id");
            $table->enum("status", [
                "RESERVED",
                "COMMITTED",
                "RELEASED",
                "EXPIRED"
            ]);
            $table->timestamp("expired_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_reservations');
    }
};
