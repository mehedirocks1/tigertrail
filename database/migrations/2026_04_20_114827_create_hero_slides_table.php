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
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            
            // Added Slogan Fields
            $table->string('title')->nullable();       // e.g., "Save the Tiger"
            $table->string('subtitle')->nullable();    // e.g., "Save Sundarbans"
            $table->text('description')->nullable();   // e.g., "Bridging fitness..."
            
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
        Schema::dropIfExists('hero_slides');
    }
};