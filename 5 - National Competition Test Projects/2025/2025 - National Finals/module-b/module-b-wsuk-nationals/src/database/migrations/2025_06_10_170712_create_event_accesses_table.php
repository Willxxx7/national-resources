<?php

use App\Models\Customer;
use App\Models\Event;
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
            $table->id('event_access_id');
            $table->foreignIdFor(Event::class, 'event_id')->constrained()->cascadeOnDelete();
            //            $table->foreignIdFor(Customer::class, 'cust_id')->constrained()->cascadeOnDelete();
            $table->text('access_code');
            $table->timestamp('access_granted_date');
            $table->boolean('is_active');
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
