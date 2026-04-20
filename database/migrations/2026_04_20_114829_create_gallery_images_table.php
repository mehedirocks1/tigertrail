<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('gallery_images', function (Blueprint $table) {
    $table->id();
    $table->string('image_path');
    $table->string('title')->nullable(); // e.g., 'Champions' (for the overlay text)
    $table->boolean('is_highlight')->default(false); // Controls the scale-105 border-brand-tiger class
    $table->integer('order')->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
    }
};
