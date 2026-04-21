<?php

namespace App\Mail;

use App\Models\Cita;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CitaCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $cita;

    public function __construct(Cita $cita)
    {
        $this->cita = $cita;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Comprobante de Cita Médica',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.cita_created',
        );
    }

    public function attachments(): array
    {
        // Generar el PDF en memoria
        $pdf = Pdf::loadView('pdfs.cita_comprobante', ['cita' => $this->cita]);

        return [
            Attachment::fromData(fn () => $pdf->output(), 'comprobante_cita.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
