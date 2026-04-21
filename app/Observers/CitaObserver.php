<?php

namespace App\Observers;

use App\Models\Cita;
use App\Services\WhatsAppService;
use App\Mail\CitaCreatedMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CitaObserver
{
    /**
     * Handle the Cita "created" event.
     */
    public function created(Cita $cita): void
    {
        $this->sendConfirmation($cita);
        $this->sendEmailConfirmation($cita);
    }

    /**
     * Send WhatsApp confirmation message.
     */
    private function sendConfirmation(Cita $cita)
    {
        try {
            // Load relations if not already loaded
            $cita->loadMissing(['patient.user', 'doctor.user']);

            $patient = $cita->patient;

            if ($patient && $patient->user && !empty($patient->user->phone)) {
                $whatsAppService = new WhatsAppService();

                $date = Carbon::parse($cita->date)->format('d/m/Y');
                $time = Carbon::parse($cita->time)->format('h:i A');
                $doctorName = $cita->doctor->user->name ?? 'su médico';

                $message = "Hola {$patient->user->name}, su cita médica ha sido confirmada para el {$date} a las {$time} con el Dr(a). {$doctorName}.";

                $whatsAppService->sendMessage($patient->user->phone, $message);
            }
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp confirmation for cita {$cita->id}: " . $e->getMessage());
        }
    }

    /**
     * Send Email confirmation with PDF.
     */
    private function sendEmailConfirmation(Cita $cita)
    {
        try {
            $cita->loadMissing(['patient.user', 'doctor.user', 'specialty']);

            $patientEmail = $cita->patient->user->email ?? null;
            $doctorEmail = $cita->doctor->user->email ?? null;

            $emails = array_filter([$patientEmail, $doctorEmail]);

            if (!empty($emails)) {
                Mail::to($emails)->send(new CitaCreatedMail($cita));
            }
        } catch (\Exception $e) {
            Log::error("Failed to send Email confirmation for cita {$cita->id}: " . $e->getMessage());
        }
    }
}
