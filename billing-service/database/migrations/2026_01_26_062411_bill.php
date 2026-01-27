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
        Schema::create('bills', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('status',[
                'CREATED',
                'RESERVING',
                'RESERVED',
                'CONFIRMING',
                'CONFIRMED',
                'FAILED',
                'CANCELLED',
                'EXPIRED',
            ]);
            $table->integer('total_amount');
            $table->string('reservation_id')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill');
    }
};
