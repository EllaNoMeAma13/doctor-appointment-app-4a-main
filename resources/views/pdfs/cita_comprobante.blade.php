<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Cita</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin: 0 auto; width: 80%; border-collapse: collapse; }
        .details th, .details td { border: 1px solid #ddd; padding: 8px; }
        .details th { background-color: #f2f2f2; text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Comprobante de Cita Médica</h2>
    </div>
    <table class="details">
        <tr>
            <th>Paciente</th>
            <td>{{ $cita->patient->user->name }}</td>
        </tr>
        <tr>
            <th>Doctor</th>
            <td>{{ $cita->doctor->user->name }}</td>
        </tr>
        <tr>
            <th>Especialidad</th>
            <td>{{ $cita->doctor->specialty->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>{{ $cita->date }}</td>
        </tr>
        <tr>
            <th>Hora</th>
            <td>{{ $cita->time }}</td>
        </tr>
        <tr>
            <th>Motivo</th>
            <td>{{ $cita->reason ?? 'N/A' }}</td>
        </tr>
    </table>
</body>
</html>
