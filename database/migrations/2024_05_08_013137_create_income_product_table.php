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
        Schema::create('income_product', function (Blueprint $table) {
            $table->id();
            // $table->double('monetary_total', 6, 2, true)->nullable(false);
            // $table->double('quantity_total', 6, 2, true)->nullable(false);
            // $table->double('unitary_total', 6, 2, true)->nullable(false);
            $table->unsignedBigInteger('income_id');
            $table->foreign('income_id')->references('id')->on('incomes');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_product');
    }
};
