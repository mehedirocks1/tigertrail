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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); 
            $table->string('slug')->unique();
            $table->text('description')->nullable(); // Required for Flagships via app validation
            
            // Status & Type
            $table->boolean('is_active')->default(true); // Control frontend visibility
            $table->boolean('is_flagship')->default(false); 
            
            // Dates & Times
            $table->dateTime('event_date'); 
            $table->dateTime('registration_deadline'); 
            
            // Location
            $table->string('location')->default('Dhaka, BD');
            $table->string('venue'); 
            
            // Race Configuration
            $table->json('categories')->nullable(); 
            $table->decimal('base_registration_fee', 10, 2)->default(1000.00); 
            
            // Participant Restrictions (Syncs with the new Form section)
            $table->boolean('allow_infants')->default(true);
            $table->boolean('allow_kids')->default(true);
            $table->boolean('allow_adults')->default(true);
            
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