<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //Llamar al RoleSeeder creado
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            BloodTypeSeeder::class,
            SpecialtySeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            CitaSeeder::class,
        ]);
        //Crea un usuario de prueba cada que ejecuto migrations
        User::firstOrCreate([
            'email' => 'cassiel@tecsoftware.com',
        ], [
            'name' => 'Cassiel Botello',
            'password' => bcrypt('cassiel'),
            'id_number' => '5555555555',
            'phone' => '5555555555',
        ])->assignRole('Administrador'); // Asigna el rol 'Administrador'

    }
}
