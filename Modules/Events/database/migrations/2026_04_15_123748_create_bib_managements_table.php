<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bib_managements', function (Blueprint $table) {

            $table->id();

            // =====================
            // RELATION
            // =====================
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            // =====================
            // BASIC INFO
            // =====================
            $table->string('category')->nullable();

            $table->integer('start_from');

            $table->integer('total_generated')->default(0);

            // =====================
            // STATUS (IMPORTANT ADDITION)
            // =====================
            $table->enum('status', ['draft', 'processing', 'completed'])
                ->default('draft');

            // =====================
            // SAFETY / CONTROL
            // =====================
            $table->boolean('is_locked')->default(false);

            $table->timestamp('generated_at')->nullable();

            // =====================
            // META
            // =====================
            $table->json('meta')->nullable();

            $table->timestamps();

            // =====================
            // INDEXING (PERFORMANCE)
            // =====================
            $table->index(['event_id', 'category']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bib_managements');
    }
};