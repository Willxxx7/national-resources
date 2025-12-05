<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\EventType;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('event_id')->primary();
            $table->unsignedInteger('cat_id');
            $table->foreign('cat_id')->references('cat_id')->on('categories');
            $table->string('event_name', 150);
            $table->enum('event_type', array_map(fn ($e) => $e->name, EventType::cases()));
            $table->string('event_city', 50);
            $table->date('event_date');
            $table->time('event_time');
            $table->string('event_note', 300)->nullable();
            $table->string('event_folder_path', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
