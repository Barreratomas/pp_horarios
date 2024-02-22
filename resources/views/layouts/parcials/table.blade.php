<table border="1">
    <thead>
        <tr>
            <th>Día</th>
            <th>Modulo Inicio</th>
            <th>Modulo Fin</th>
            <th>V/P</th>
            <th>Aula</th>
            <th>Materia</th>
           
        </tr>
    </thead>
    <tbody>
        {{-- verifico existen horarios --}}
        @foreach ($horarios ?? [] as $horario)
            <tr>
                {{-- si no existen los registros muestro na --}}
                <td>{{ $horario->dia ? $horario->dia : 'N/A' }}</td>
                <td>{{ $horario->modulo_inicio ? $horario->modulo_inicio : 'N/A' }}</td>
                <td>{{ $horario->modulo_fin ? $horario->modulo_fin : 'N/A' }}</td>
                <td>{{ $horario->v_p == 'p' ? 'Presencial' : 'Virtual' }}</td>
                <td>{{ $horario->modulo_inicio ? $horario->aula : 'N/A' }}</td>
                <td>{{ $horario->modulo_inicio ? $horario->materia : 'N/A' }}</td>
                
                
            </tr>
        @endforeach
    </tbody>
</table>