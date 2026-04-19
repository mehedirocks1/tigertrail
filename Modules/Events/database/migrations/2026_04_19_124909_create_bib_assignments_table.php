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
            
            // ১. আপনার তৈরি করা bib_managements টেবিলের সাথে কানেকশন
            $table->foreignId('bib_management_id')->constrained('bib_managements')->cascadeOnDelete();
            
            // ২. আসল অ্যাটেন্ডির সাথে কানেকশন
            $table->foreignId('attendee_id')->constrained('attendees')->cascadeOnDelete();

            // ৩. জেনারেটেড বিব নাম্বার
            $table->integer('bib_number')->unique();

            // ৪. তথ্যের স্ন্যাপশট (Attendee টেবিল থেকে যা যা এখানে কপি হয়ে থাকবে)
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email');
            $table->string('race_category');
            $table->string('t_shirt_size');
            $table->string('blood_group')->nullable();
            $table->string('gender');
            $table->string('photo_path')->nullable(); 

            // ৫. কিট ডিস্ট্রিবিউশন চেক
            $table->boolean('is_kit_collected')->default(false);
            $table->timestamp('collected_at')->nullable();

            $table->timestamps();

            // দ্রুত সার্চ করার জন্য ইনডেক্স
            $table->index(['bib_number', 'phone']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bib_assignments');
    }
};