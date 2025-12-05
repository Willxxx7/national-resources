<?php

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
        Schema::create('pictures', function (Blueprint $table) {
            $table->id('pic_id');
            $table->foreignIdFor(Event::class, 'event_id')->constrained()->cascadeOnDelete();
            $table->string('pic_name', 300);
            $table->timestamp('pic_upload_date');
            $table->string('pic_note', 300)->nullable();
            $table->string('pic_locator', 10)->unique()->nullable();
            $table->boolean('pic_is_active');
            $table->string('pic_path', 255);
            $table->string('pic_upload_note', 300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
