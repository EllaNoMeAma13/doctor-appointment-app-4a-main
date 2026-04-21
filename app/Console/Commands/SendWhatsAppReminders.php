<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Cita;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class SendWhatsAppReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-whatsapp-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send WhatsApp reminders for appointments scheduled for tomorrow';

    /**
     * Execute the console command.
     */
    public function handle(WhatsAppService $whatsAppService)
    {
        // Get tomorrow's date
        $tomorrow = Carbon::tomorrow()->toDateString();

        $this->info("Looking for appointments on {$tomorrow}...");

        $citas = Cita::with(['patient.user', 'doctor.user'])
            ->whereDate('date', $tomorrow)
            ->get();

        $count = 0;

        foreach ($citas as $cita) {
            $patient = $cita->patient;

            if ($patient && $patient->user && !empty($patient->user->phone)) {
                $doctorName = $cita->doctor->user->name ?? 'su doctor';
                $time = Carbon::parse($cita->time)->format('h:i A');

                $message = "Hola {$patient->user->name}, este es un recordatorio de su cita médica mañana a las {$time} con el Dr(a). {$doctorName}. ¡Le esperamos!";

                $whatsAppService->sendMessage($patient->user->phone, $message);
                $count++;

                // Add a small delay to avoid rate limiting
                sleep(2);
            }
        }

        $this->info("Sent {$count} WhatsApp reminders successfully.");
        Log::info("Sent {$count} WhatsApp reminders for appointments on {$tomorrow}.");
    }
}
