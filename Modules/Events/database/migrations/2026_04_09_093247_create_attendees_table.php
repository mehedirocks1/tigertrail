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

        // 1. Personal Information
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->string('phone');
        $table->date('date_of_birth');
        $table->string('age_category')->nullable(); // Auto-calculated on frontend, stored here
        $table->string('gender');
        $table->string('nationality')->nullable();

        // 2. Race Information
        $table->string('race_category'); // 5K, 7.5K, 10K, Half Marathon
        $table->string('t_shirt_size'); // S, M, L, XL, XXL
        $table->string('expected_finish_time')->nullable();
        $table->string('club_or_team')->nullable();
        $table->integer('previous_marathons')->default(0)->nullable();

        // 3. Health & Emergency
        $table->string('blood_group');
        $table->string('medical_conditions')->nullable();
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
        $table->string('photo_path'); // Stores the path to the uploaded Runner ID Photo
        $table->decimal('registration_fee', 8, 2); // The 1000 BDT fee
        $table->boolean('waiver_accepted')->default(false);
        $table->boolean('terms_accepted')->default(false);
        $table->string('transaction_id')->nullable()->unique()->after('registration_fee');
        // Payment Tracking (Because the form button says "Proceed to Payment")
        $table->string('payment_status')->default('pending'); // pending, completed, failed

        $table->timestamps();
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
