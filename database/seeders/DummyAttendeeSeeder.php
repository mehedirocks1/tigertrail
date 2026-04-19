<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // <-- This fixes the DB error
use Illuminate\Support\Str;        // <-- This fixes the Str::random() error

class DummyAttendeeSeeder extends Seeder
{
   public function run(): void
    {
        // Find the highest serial number currently in the database for event_id 1
        $highestSerial = DB::table('attendees')
            ->where('event_id', 1)
            ->max('serial_number') ?? 1; // Default to 1 if table is empty

        // Start generating from the next available number
        $start = $highestSerial + 1;
        $end = $start + 99; // Insert exactly 100 new rows

        for ($i = $start; $i <= $end; $i++) {
            DB::table('attendees')->insert([
                'event_id' => 1,
                'serial_number' => $i,
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'phone' => fake()->phoneNumber(),
                'date_of_birth' => fake()->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
                'age_category' => 'Adult Runner',
                'gender' => fake()->randomElement(['Male', 'Female']),
                'nationality' => 'Bangladeshi',
                'race_category' => fake()->randomElement(['10KM Marathon']),
                't_shirt_size' => fake()->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
                'expected_finish_time' => fake()->randomElement(['1:30', '2:00', '2:30', '3:00']),
                'club_or_team' => fake()->optional()->company() ?? 'Independent',
                'previous_marathons' => fake()->numberBetween(0, 10),
                'blood_group' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
                'medical_conditions' => 'None',
                'emergency_contact_name' => fake()->name(),
                'emergency_contact_phone' => fake()->phoneNumber(),
                'emergency_contact_relation' => fake()->randomElement(['Father', 'Mother', 'Spouse', 'Friend']),
                'address_line' => fake()->streetAddress(),
                'city' => 'Dhaka',
                'state_or_district' => 'Dhaka',
                'postal_code' => fake()->postcode(),
                'country' => 'Bangladesh',
                'photo_path' => 'attendee-photos/dummy_photo_' . $i . '.jpg',
                'registration_fee' => 1000.00,
                'transaction_id' => 'TRUN_' . strtoupper(Str::random(10)),
                'payment_status' => 'Success',
                'waiver_accepted' => 1,
                'terms_accepted' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}