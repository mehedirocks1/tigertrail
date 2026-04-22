<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DummyAttendeeSeeder extends Seeder
{
    public function run(): void
    {
        $events = DB::table('events')->get();

        foreach ($events as $event) {

            // categories JSON decode (IMPORTANT)
            $categories = json_decode($event->categories, true);

            if (!is_array($categories)) {
                continue;
            }

            foreach ($categories as $category) {

                // serial per event (safe)
                $highestSerial = DB::table('attendees')
                    ->where('event_id', $event->id)
                    ->max('serial_number') ?? 0;

                $start = $highestSerial + 1;

                for ($i = 0; $i < 100; $i++) {

                    DB::table('attendees')->insert([
                        'event_id' => $event->id,
                        'serial_number' => $start + $i,

                        'first_name' => fake()->firstName(),
                        'last_name' => fake()->lastName(),
                        'email' => fake()->unique()->safeEmail(),
                        'phone' => fake()->phoneNumber(),

                        'date_of_birth' => fake()->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),

                        'age_category' => 'Adult Runner',
                        'gender' => fake()->randomElement(['Male', 'Female']),
                        'nationality' => 'Bangladeshi',

                        'race_category' => $category,

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

                        'photo_path' => 'attendee-photos/dummy_' . $event->id . '_' . ($start + $i) . '.jpg',

                        'registration_fee' => $event->base_registration_fee,

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
    }
}