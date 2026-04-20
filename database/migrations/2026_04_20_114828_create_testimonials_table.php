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
       Schema::create('testimonials', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // e.g., 'Asif Rahman'
    $table->string('title')->nullable(); // e.g., 'Marathon Runner'
    $table->string('avatar_path')->nullable();
    $table->text('review');
    $table->integer('rating')->default(5); // 1-5 scale
    $table->boolean('is_approved')->default(true);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
