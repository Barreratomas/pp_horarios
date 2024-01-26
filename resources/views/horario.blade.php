<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horarios</title>
</head>
<body>
    <h1>Horarios</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Día</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>aula</th>
                <th>materia</th>
                <th>Comisión</th>
                <!-- Agrega más columnas según tus necesidades -->
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $horario)
    <tr>
        <td>{{ $horario->dia }}</td>
        <td>{{ $horario->hora_inicio }}</td>
        <td>{{ $horario->hora_fin }}</td>
        <td>{{ $horario->aula ? $horario->aula->nombre : 'N/A' }}</td>
        <td>{{ $horario->docenteMateria ? $horario->docenteMateria->materia->nombre : 'N/A' }}</td>
        <td>{{ $horario->comision ? $horario->comision->anio : 'N/A' }}°{{$horario->comision ? $horario->comision->division : 'N/A' }}</td>
        <!-- Agrega más celdas según tus necesidades -->
    </tr>
@endforeach

        </tbody>
    </table>
</body>
</html>



