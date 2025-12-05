<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id('event_id');
            $table->foreignIdFor(Category::class, 'cat_id')->nullable()->constrained()->nullOnDelete();
            $table->string('event_name', 150);
            $table->enum('event_type', ['private', 'public']);
            $table->string('event_city', 50);
            $table->date('event_date');
            $table->time('event_time');
            $table->string('event_note', 300)->nullable();
            $table->string('event_folder_path', 255)->nullable();
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
