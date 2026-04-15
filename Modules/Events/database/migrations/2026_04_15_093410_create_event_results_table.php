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
      Schema::create('event_results', function (Blueprint $table) {
            $table->id();
            
            // Event এর সাথে রিলেশন
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            
            // রেজাল্টের বিস্তারিত
            $table->integer('rank');
            $table->string('bib_number');
            $table->string('athlete_name');
            $table->string('category');
            $table->string('net_time');
            $table->string('pace');
            
            $table->timestamps();

            // একই ইভেন্টে একই BIB নাম্বারের যেন ডুপ্লিকেট এন্ট্রি না হয়
            $table->unique(['event_id', 'bib_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_results');
    }
};
