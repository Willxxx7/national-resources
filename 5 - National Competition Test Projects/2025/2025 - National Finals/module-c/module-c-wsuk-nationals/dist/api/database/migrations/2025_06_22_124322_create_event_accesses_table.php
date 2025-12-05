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
        Schema::create('event_accesses', function (Blueprint $table) {
            $table->unsignedInteger('event_id');
            $table->unsignedInteger('cust_id');

            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('cust_id')->references('cust_id')->on('customers');
            $table->primary(['cust_id', 'event_id']);

            $table->string('access_code', 100);
            $table->timestamp('access_granted_date');
            $table->boolean('is_active')->default(true);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_accesses');
    }
};
