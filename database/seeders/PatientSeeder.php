<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assuming users with role 'paciente' exist or we create some dummy patients
        // For now, let's just ensure we have some logic here if needed.
        // Since the prompt asks for a seeder, but patients are usually linked to users,
        // we might want to find users with the role 'paciente' and create patient records for them if they don't exist.

        $users = User::role('paciente')->get();

        foreach ($users as $user) {
            Patient::firstOrCreate([
                'user_id' => $user->id
            ], [
                'blood_type_id' => 1, // Default to first blood type or random
                'address' => 'Dirección de prueba',
                'emergency_contact_name' => 'Contacto de emergencia',
                'emergency_contact_phone' => '1234567890'
            ]);
        }
    }
}
