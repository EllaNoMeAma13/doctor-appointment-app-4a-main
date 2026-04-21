<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DailyScheduleMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $citas;
    public $recipientType; // 'admin' o 'doctor'
    public $doctorName;

    public function __construct($citas, $recipientType, $doctorName = null)
    {
        $this->citas = $citas;
        $this->recipientType = $recipientType;
        $this->doctorName = $doctorName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Agenda Médica del Día - ' . now()->format('Y-m-d'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.daily_schedule',
        );
    }
}
