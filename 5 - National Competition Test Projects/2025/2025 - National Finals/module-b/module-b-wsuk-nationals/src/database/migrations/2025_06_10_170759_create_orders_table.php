<?php

use App\Models\Customer;
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
            $table->id('order_id');
            $table->foreignIdFor(Customer::class, 'cust_id')->constrained()->cascadeOnDelete();
            $table->date('order_date');
            $table->string('order_note', 300)->nullable();
            $table->timestamp('order_completed_at')->nullable();
            $table->timestamp('order_cancelled_at')->nullable();
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
