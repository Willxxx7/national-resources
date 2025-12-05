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
        Schema::create('order_pictures', function (Blueprint $table) {
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('pic_id');
            $table->unsignedInteger('pic_size_id');

            $table->foreign('order_id')->references('order_id')->on('orders')->cascadeOnDelete();
            $table->foreign('pic_id')->references('pic_id')->on('pictures');
            $table->foreign('pic_size_id')->references('pic_size_id')->on('picture_sizes');

            $table->primary(['order_id', 'pic_id', 'pic_size_id']);

            $table->unsignedInteger('pic_qty');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pictures');
    }
};
