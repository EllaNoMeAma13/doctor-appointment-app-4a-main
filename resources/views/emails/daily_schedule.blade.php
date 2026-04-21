<!DOCTYPE html>
<html>
<head>
    <title>Agenda del Día</title>
</head>
<body>
    @if($recipientType === 'admin')
        <h1>Agenda General del Día - {{ now()->format('Y-m-d') }}</h1>
        <p>A continuación se listan todas las citas agendadas para el día de hoy:</p>
    @else
        <h1>Hola Dr(a). {{ $doctorName }}, Agenda de Hoy - {{ now()->format('Y-m-d') }}</h1>
        <p>A continuación se listan sus pacientes agendados para el día de hoy:</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Hora</th>
                <th>Paciente</th>
                @if($recipientType === 'admin')
                    <th>Doctor</th>
                @endif
                <th>Especialidad</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($citas as $cita)
                <tr>
                    <td>{{ $cita->time }}</td>
                    <td>{{ $cita->patient->user->name ?? 'N/A' }}</td>
                    @if($recipientType === 'admin')
                        <td>{{ $cita->doctor->user->name ?? 'N/A' }}</td>
                    @endif
                    <td>{{ $cita->specialty->name ?? 'N/A' }}</td>
                    <td>{{ $cita->reason ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $recipientType === 'admin' ? 5 : 4 }}" style="text-align: center;">No hay citas agendadas para hoy.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
