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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('cust_id');
            $table->string('cust_fname', 75);
            $table->string('cust_lname', 75);
            $table->string('cust_email', 150);
            $table->string('cust_phone', 15)->nullable();
            $table->string('cust_addr1', 50);
            $table->string('cust_addr2', 50)->nullable();
            $table->string('cust_postcode', 8);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
