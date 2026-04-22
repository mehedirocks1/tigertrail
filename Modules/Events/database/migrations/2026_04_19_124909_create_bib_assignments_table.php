<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bib_assignments', function (Blueprint $table) {
            $table->id();

            // =========================
            // RELATIONS
            // =========================

            // Event reference (IMPORTANT FIX)
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('bib_management_id')
                ->constrained('bib_managements')
                ->cascadeOnDelete();

            $table->foreignId('attendee_id')
                ->constrained('attendees')
                ->cascadeOnDelete();

            // =========================
            // BIB DATA
            // =========================

            $table->integer('bib_number')->index();

            // =========================
            // SNAPSHOT DATA (immutable record)
            // =========================

            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone')->index();
            $table->string('email')->nullable();

            $table->string('race_category')->index();
            $table->string('t_shirt_size')->nullable();

            $table->string('blood_group')->nullable();
            $table->string('gender')->nullable();

            $table->string('photo_path')->nullable();

            // =========================
            // KIT DISTRIBUTION
            // =========================

            $table->boolean('is_kit_collected')->default(false);
            $table->timestamp('collected_at')->nullable();

            // =========================
            // META
            // =========================

            $table->timestamps();

            // Prevent duplicate bib per event
            $table->unique(['event_id', 'bib_number']);

            // Fast queries
            $table->index(['event_id', 'race_category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bib_assignments');
    }
};