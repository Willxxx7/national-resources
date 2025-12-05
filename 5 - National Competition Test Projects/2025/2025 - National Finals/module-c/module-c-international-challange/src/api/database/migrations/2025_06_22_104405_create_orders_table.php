<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id')->primary();
            $table->unsignedInteger('cust_id');
            $table->foreign('cust_id')->references('cust_id')->on('customers');
            $table->date('order_date');
            $table->string('order_note', 300)->nullable();
            $table->enum('order_status', ['confirmed', 'paid', 'cancelled'])->default('confirmed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
