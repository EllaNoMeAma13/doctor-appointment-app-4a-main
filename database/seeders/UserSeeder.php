<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'paciente@gmail.com'],
            [
                'name' => 'Paciente',
                'password' => Hash::make('password'),
                'id_number' => '1111111111',
                'phone' => '1111111111',
            ]
        )->assignRole('Paciente');

        User::updateOrCreate(
            ['email' => 'doctor@gmail.com'],
            [
                'name' => 'Doctor',
                'password' => Hash::make('password'),
                'id_number' => '2222222222',
                'phone' => '2222222222',
            ]
        )->assignRole('Doctor');

        User::updateOrCreate(
            ['email' => 'recepcionista@gmail.com'],
            [
                'name' => 'Recepcionista',
                'password' => Hash::make('password'),
                'id_number' => '3333333333',
                'phone' => '3333333333',
            ]
        )->assignRole('Recepcionista');

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'id_number' => '4444444444',
                'phone' => '4444444444',
            ]
        )->assignRole('Administrador');

        User::factory(10)->create()->each(function ($user) {
            $user->assignRole('Paciente');
        });

        // Create 5 additional dummy doctors
        User::factory(5)->create()->each(function ($user) {
            $user->assignRole('Doctor');
        });
    }
}
