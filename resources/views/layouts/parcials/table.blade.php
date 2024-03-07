@if (Session::get('userType') == 'bedelia' || Session::get('userType') == 'admin' && request()->route()->named('mostrarHorarioBedelia'))
@foreach ($horariosAgrupados as $anio => $divisionesPorAnio)
<h2>Año: {{ $anio }}</h2>
<table border="1">
    <thead>
        <tr>
            <th>Día</th>
            <th>Modulo Inicio</th>
            <th>Modulo Fin</th>
            <th>V/P</th>
            <th>Aula</th>
            <th>Materia</th>
            <th>comision</th>
            <th>docente</th>

            <!-- Agrega más encabezados según tus necesidades -->
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
        @foreach ($divisionesPorAnio as $division => $horariosPorDivision)
            <tr>
                <td colspan="3"><strong>División:</strong> {{ $division }}</td>
            </tr>
            @foreach ($horariosPorDivision as $horario)
                <tr>
                     {{-- si no existen los registros muestro na --}}
                <td>{{ $horario->dia ? $horario->dia : 'N/A' }}</td>
                <td>{{ isset($horario->modulo_inicio) && isset($horasPermitidas[$horario->modulo_inicio]) ? $horasPermitidas[$horario->modulo_inicio] : 'N/A' }}</td>
                <td>{{ isset($horario->modulo_fin) && isset($horasPermitidas[$horario->modulo_fin]) ? $horasPermitidas[$horario->modulo_fin] : 'N/A' }}</td>
                <td>{{ $horario->v_p == 'p' ? 'Presencial' : 'Virtual' }}</td>
                <td>{{ $horario->aula ? $horario->aula : 'N/A' }}</td>
                <td>{{  $horario->materia? $horario->materia  : 'N/A' }}</td>
                <td>{{  $horario->anio ? $horario->anio  : 'N/A' }}°{{  $horario->division ? $horario->division  : 'N/A'}} </td>
                <td>{{  $horario->disponibilidad->docenteMateria->docente->nombre ? $horario->disponibilidad->docenteMateria->docente->nombre   : 'N/A' }} {{  $horario->disponibilidad->docenteMateria->docente->apellido ? $horario->disponibilidad->docenteMateria->docente->apellido : 'N/A'}} </td>



                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endforeach
@endif

@if (Session::get('userType') == 'estudiante' || Session::get('userType') == 'admin' && request()->route()->named('mostrarHorario'))
<table border="1">
    <thead>
        <tr>
            <th>Día</th>
            <th>Modulo Inicio</th>
            <th>Modulo Fin</th>
            <th>V/P</th>
            <th>Aula</th>
            <th>Materia</th>
            <th>Docente</th>
            <th>asdas</th>



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
                <td>{{ $horario->aula ? $horario->aula : 'N/A' }}</td>
                <td>{{  $horario->materia? $horario->materia  : 'N/A' }}</td>
                <td>{{  $horario->disponibilidad->docenteMateria->docente->nombre ? $horario->disponibilidad->docenteMateria->docente->nombre   : 'N/A' }} {{  $horario->disponibilidad->docenteMateria->docente->apellido ? $horario->disponibilidad->docenteMateria->docente->apellido : 'N/A'}} </td>


            </tr>
        @endforeach
    </tbody>
</table>
@endif

@if (Session::get('userType') == 'docente' || Session::get('userType') == 'admin' && request()->route()->named('mostrarHorarioDocente'))
@foreach ($horariosAgrupados as $anio => $divisionesPorAnio)
<h2>Año: {{ $anio }}</h2>
<table border="1">
    <thead>
        <tr>
            <th>Día</th>
            <th>Modulo Inicio</th>
            <th>Modulo Fin</th>
            <th>V/P</th>
            <th>Aula</th>
            <th>Materia</th>
            <th>comision</th>
            <!-- Agrega más encabezados según tus necesidades -->
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
        @foreach ($divisionesPorAnio as $division => $horariosPorDivision)
            <tr>
                <td colspan="3"><strong>División:</strong> {{ $division }}</td>
            </tr>
            @foreach ($horariosPorDivision as $horario)
                <tr>
                     {{-- si no existen los registros muestro na --}}
                <td>{{ $horario->dia ? $horario->dia : 'N/A' }}</td>
                <td>{{ isset($horario->modulo_inicio) && isset($horasPermitidas[$horario->modulo_inicio]) ? $horasPermitidas[$horario->modulo_inicio] : 'N/A' }}</td>
                <td>{{ isset($horario->modulo_fin) && isset($horasPermitidas[$horario->modulo_fin]) ? $horasPermitidas[$horario->modulo_fin] : 'N/A' }}</td>
                <td>{{ $horario->v_p == 'p' ? 'Presencial' : 'Virtual' }}</td>
                <td>{{ $horario->aula ? $horario->aula : 'N/A' }}</td>
                <td>{{  $horario->materia? $horario->materia  : 'N/A' }}</td>
                <td>{{  $horario->anio ? $horario->anio  : 'N/A' }}°{{  $horario->division ? $horario->division  : 'N/A'}} </td>


                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endforeach
@endif
