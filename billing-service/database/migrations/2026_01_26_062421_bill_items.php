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
        Schema::create('bill_items',function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->uuid('bill_id');
            $table->uuid('product_id');
            $table->foreign('bill_id')
                  ->references('id')
                  ->on('bills')
                  ->onDelete('cascade');
            $table->integer('qty');
            $table->decimal('unitPrice',12,2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
