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
        Schema::create('pictures', function (Blueprint $table) {
            $table->increments('pic_id')->primary();
            $table->unsignedInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->unsignedInteger('cat_id');
            $table->foreign('cat_id')->references('cat_id')->on('categories');
            $table->string('pic_name', 300);
            $table->timestamp('pic_upload_date');
            $table->string('pic_locator', 10)->unique()->nullable();
            $table->string('pic_upload_note', 300)->nullable();
            $table->boolean('pic_is_active')->default(true);
            $table->string('pic_path', 500);
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
