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
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable(); // e.g., 'Dhaka Marathon 2025'
            $table->string('category')->default('General'); // For the filter buttons
            
            // Layout Controls
            $table->integer('col_span')->default(1); // 1 or 2
            $table->integer('row_span')->default(1); // 1 or 2
            $table->boolean('is_highlight')->default(false); // <-- ADDED THIS MISSING COLUMN!
            
            // Sorting and Visibility
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