<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => 'Cardiología'],
            ['name' => 'Pediatría'],
            ['name' => 'Dermatología'],
            ['name' => 'Ginecología'],
            ['name' => 'Neurología'],
            ['name' => 'Oncología'],
            ['name' => 'Oftalmología'],
            ['name' => 'Traumatología'],
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
