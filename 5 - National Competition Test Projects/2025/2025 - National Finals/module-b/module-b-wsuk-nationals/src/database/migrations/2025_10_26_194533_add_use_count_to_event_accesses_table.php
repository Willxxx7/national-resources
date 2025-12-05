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
        Schema::table('event_accesses', function (Blueprint $table) {
            $table->unsignedInteger('use_count')->default(0)->after('last_used_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('event_accesses', function (Blueprint $table) {
            $table->dropColumn('use_count');
        });
    }
};
