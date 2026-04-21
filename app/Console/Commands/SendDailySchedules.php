<?php

namespace App\Console\Commands;

use App\Mail\DailyScheduleMail;
use App\Models\Cita;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailySchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-schedules';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia el reporte de citas diarias al administrador y a los doctores';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = now()->format('Y-m-d');

        $citasToday = Cita::with(['patient.user', 'doctor.user', 'specialty'])
            ->whereDate('date', $today)
            ->orderBy('time', 'asc')
            ->get();

        if ($citasToday->isEmpty()) {
            $this->info("No hay citas agendadas para el dia de hoy.");
            return;
        }

        // 1. Enviar al administrador
        // Asumimos que los administradores tienen un rol 'admin'
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new DailyScheduleMail($citasToday, 'admin'));
            $this->info("Correo enviado al administrador: {$admin->email}");
        }

        // 2. Enviar a cada doctor
        $citasPorDoctor = $citasToday->groupBy('doctor_id');

        foreach ($citasPorDoctor as $doctorId => $citasDelDoctor) {
            $doctorUser = $citasDelDoctor->first()->doctor->user;

            if ($doctorUser) {
                Mail::to($doctorUser->email)->send(new DailyScheduleMail($citasDelDoctor, 'doctor', $doctorUser->name));
                $this->info("Correo enviado al doctor: {$doctorUser->email}");
            }
        }

        $this->info('Reportes de citas diarias enviados correctamente.');
    }
}
