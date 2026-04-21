<?php

namespace Database\Seeders;

use App\Models\SupportTicket;
use App\Models\User;
use Illuminate\Database\Seeder;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el usuario 'cassiel@tecsoftware.com' que se crea en el DatabaseSeeder
        $user = User::where('email', 'cassiel@tecsoftware.com')->first();

        if (!$user) {
            $user = User::first();
        }

        if ($user) {
            SupportTicket::create([
                'user_id' => $user->id,
                'subject' => 'Problema con mi cita',
                'message' => 'No puedo ver mi cita agendada en el sistema, necesito ayuda para confirmarla.',
                'status' => 'open',
            ]);

            SupportTicket::create([
                'user_id' => $user->id,
                'subject' => 'Actualizar datos',
                'message' => 'Me gustaría cambiar mi correo electrónico registrado.',
                'status' => 'in_progress',
            ]);

            SupportTicket::create([
                'user_id' => $user->id,
                'subject' => 'Duda sobre receta',
                'message' => 'El médico me recetó un medicamento pero no entiendo cada cuántas horas tomarlo.',
                'status' => 'closed',
            ]);
        }
    }
}
