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
 Schema::create('race_kits', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // e.g., 'Event T-Shirt'
    $table->string('subtitle')->nullable(); // e.g., 'Premium Jersey'
    $table->string('image_path');
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
        Schema::dropIfExists('race_kits');
    }
};
