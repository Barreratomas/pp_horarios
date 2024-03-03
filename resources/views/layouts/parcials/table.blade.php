
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
        @php
        
        $horasPermitidas = [
            1 => '19:20',
            2 => '20:00',
            3 => '20:40',
            4 => '21:20',
            5 => '21:30',
            6 => '22:10',
            7 => '22:50',
        ];
        @endphp
        {{-- verifico existen horarios --}}
        @foreach ($horarios ?? [] as $horario)
            <tr>
                {{-- si no existen los registros muestro na --}}
                <td>{{ $horario->dia ? $horario->dia : 'N/A' }}</td>
                <td>{{ isset($horario->modulo_inicio) && isset($horasPermitidas[$horario->modulo_inicio]) ? $horasPermitidas[$horario->modulo_inicio] : 'N/A' }}</td>
                <td>{{ isset($horario->modulo_fin) && isset($horasPermitidas[$horario->modulo_fin]) ? $horasPermitidas[$horario->modulo_fin] : 'N/A' }}</td>
                <td>{{ $horario->v_p == 'p' ? 'Presencial' : 'Virtual' }}</td>
                <td>{{ $horario->disponibilidad->docenteMateria->aula->nombre ? $horario->disponibilidad->docenteMateria->aula->nombre : 'N/A' }}</td>
                <td>{{  $horario->disponibilidad->docenteMateria->materia->nombre ? $horario->disponibilidad->docenteMateria->materia->nombre  : 'N/A' }}</td>
                
                
            </tr>
        @endforeach
    </tbody>
</table>