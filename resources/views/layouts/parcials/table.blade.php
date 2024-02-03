<table border="1">
    <thead>
        <tr>
            <th>Día</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Aula</th>
            <th>Materia</th>
            <th>Comisión</th>
            <th>Carrera</th>
        </tr>
    </thead>
    <tbody>
        {{-- verifico existen horarios --}}
        @foreach ($horarios ?? [] as $horario)
            <tr>
                {{-- si no existen los registros muestro na --}}
                <td>{{ $horario->dia ? $horario->dia : 'N/A' }}</td>
                <td>{{ $horario->hora_inicio ? $horario->hora_inicio : 'N/A' }}</td>
                <td>{{ $horario->hora_fin ? $horario->hora_fin : 'N/A' }}</td>
                <td>{{ $horario->aula ? $horario->aula->nombre : 'N/A' }}</td>
                <td>{{ $horario->docenteMateria ? $horario->docenteMateria->materia->nombre : 'N/A' }}</td>
                <td>{{ $horario->comision ? $horario->comision->anio : 'N/A' }}°{{ $horario->comision ? $horario->comision->division : 'N/A' }}</td>
                <td>{{ $horario->comision ? $horario->comision->carrera->nombre : 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>