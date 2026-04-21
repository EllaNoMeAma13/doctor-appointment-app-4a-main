<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $specialties = Specialty::all();

        for ($i = 0; $i < 50; $i++) {
            Cita::create([
                'patient_id' => $patients->random()->id,
                'doctor_id' => $doctors->random()->id,
                'specialty_id' => $specialties->random()->id,
                'date' => now()->addDays(rand(1, 30)),
                'time' => now()->addHours(rand(1, 12))->format('H:i:s'),
                'status' => ['pending', 'confirmed', 'cancelled'][rand(0, 2)],
            ]);
        }
    }
}
