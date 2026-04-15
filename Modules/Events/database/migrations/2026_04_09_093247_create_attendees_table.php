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
        Schema::create('attendees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            
            // নতুন যোগ করা হলো: ইভেন্ট-ভিত্তিক সিরিয়াল নাম্বার
            $table->unsignedInteger('serial_number');

            // 1. Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->index(); // দ্রুত সার্চের জন্য ইনডেক্স করা হলো
            $table->string('phone');
            $table->date('date_of_birth');
            $table->string('age_category')->nullable(); 
            $table->string('gender');
            $table->string('nationality')->nullable();

            // 2. Race Information
            $table->string('race_category'); 
            $table->string('t_shirt_size'); 
            $table->string('expected_finish_time')->nullable();
            $table->string('club_or_team')->nullable();
            $table->integer('previous_marathons')->default(0)->nullable();

            // 3. Health & Emergency
            $table->string('blood_group');
            $table->text('medical_conditions')->nullable(); 
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_relation');

            // 4. Mailing Address
            $table->string('address_line');
            $table->string('city');
            $table->string('state_or_district');
            $table->string('postal_code');
            $table->string('country')->default('Bangladesh');

            // 5. Final Steps (Files, Fees, & Agreements)
            $table->string('photo_path'); 
            $table->decimal('registration_fee', 10, 2); 
            
            $table->string('transaction_id')->nullable()->unique(); 
            
            $table->string('payment_status')->default('Pending'); 
            $table->boolean('waiver_accepted')->default(false);
            $table->boolean('terms_accepted')->default(false);

            $table->timestamps();

            // --- Database Constraints & Indexes ---
            
            // একই ইভেন্টে যেন একই সিরিয়াল দুইবার না আসে তা নিশ্চিত করতে:
            $table->unique(['event_id', 'serial_number']);
            
            // Prunable (অসম্পূর্ণ পেমেন্ট ডিলিট করার টাস্ক) দ্রুত কাজ করার জন্য ইনডেক্স:
            $table->index(['payment_status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendees');
    }
};