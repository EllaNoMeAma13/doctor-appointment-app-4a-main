<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Cita Médica</title>
</head>
<body>
    <h1>Cita Médica Confirmada</h1>
    <p>Hola,</p>
    <p>Adjunto a este correo encontrarás el comprobante de la cita médica programada.</p>
    <p>Fecha: {{ $cita->date }}</p>
    <p>Hora: {{ $cita->time }}</p>
    <p>Saludos,</p>
</body>
</html>
