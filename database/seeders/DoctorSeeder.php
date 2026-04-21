<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users with the 'Doctor' role
        $doctorUsers = User::role('Doctor')->get();
        $specialties = Specialty::all();
        $faker = Faker::create('es_ES'); // Usamos el localizador en español

        if ($doctorUsers->isEmpty() || $specialties->isEmpty()) {
            $this->command->info('No users with Doctor role or no specialties found. Please run UserSeeder and SpecialtySeeder first.');
            return;
        }

        foreach ($doctorUsers as $user) {
            $doctorProfile = Doctor::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'specialty_id' => $specialties->random()->id,
                    'medical_license_number' => $faker->unique()->numerify('########'),
                    'biography' => $faker->paragraph(3),
                ]
            );

            // Create default schedules for each doctor from Monday to Friday
            $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
            foreach ($days as $day) {
                $doctorProfile->schedules()->updateOrCreate(
                    ['day_of_week' => $day],
                    ['start_time' => '09:00', 'end_time' => '17:00', 'status' => 'active']
                );
            }
        }
    }
}