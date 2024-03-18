@if (Session::get('userType') == 'bedelia' || Session::get('userType') == 'admin' && request()->route()->named('mostrarHorarioBedelia'))
        
    @foreach ($horariosAgrupados as $carrera => $horariosPorCarrera)
        <h2>Carrera: {{ $carrera }}</h2>

        @foreach ($horariosPorCarrera->groupBy('anio') as $anio => $divisionesPorAnio)
            <h3>Año: {{ $anio }}</h3>

            @foreach ($divisionesPorAnio->groupBy('division') as $division => $horariosPorDivision)
                <h4>Division: {{ $division }}</h4> 
                
                <table class="border px-4 py-2 mb-5">
                    <thead>
                        @php
                            $inicio = [
                                1 => '19:20',
                                2 => '20:00',
                                3 => '20:40',
                                4 => '21:30',
                                5 => '22:10',
                                6 => '22:50'
                            ];
                            $fin = [
                                1 => '20:00',
                                2 => '20:40',
                                3 => '21:20',
                                4 => '22:10',
                                5 => '22:50',
                                6 => '23:30'
                            ];
                            
                            $dias = [
                                1 => 'lunes',  
                                2 => 'martes',
                                3 => 'miercoles',
                                4 => 'jueves',
                                5 => 'viernes'
                            ];
                        
                        @endphp
    
                        <tr>
                            <th class="border px-4 py-2" >Días / Horarios</th>
                            @for($i = 1; $i < 7; $i++)
                                <th class="border px-4 py-2">{{$inicio[$i]}} - {{$fin[$i]}}</th>
                            @endfor
                        </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($dias as  $dia)
                                <tr>
                                    <th class="border px-4 py-2">{{$dia}}</th>
                                    @php
                                        $moduloAnterior=0
                                        @endphp
                                        @foreach ($horariosPorDivision as $horario)
                                      
                                            @if($horario->dia == $dia)
                                           
                                                @foreach ($inicio as $modulo =>$hora)
    
                                                    @if( $modulo >= $horario->modulo_inicio && $modulo < $horario->modulo_fin ) 
                                                    @php
                                                        $moduloAnterior++;
                                                        @endphp
                                                        <td class="border px-4 py-2">
                                                             <div >{{$horario->disponibilidad->docenteMateria->materia->nombre}}</div>
                                                            <div>{{$horario->disponibilidad->docenteMateria->aula->nombre}}</div>
                                                            <div>{{ $horario->v_p == 'p' ? 'Presencial' : 'Virtual' }}</div> 
                                                            <div>{{$horario->disponibilidad->docenteMateria->comision->carrera->nombre}}</div>
                                                            <div>{{$horario->modulo_inicio}}</div>
                                                            <div>{{$horario->modulo_fin}}</div>

    
    
                                                        </td>
    
                                                    
                                                        
                                                    @elseif($modulo>=$horario->modulo_fin)
                                                   
                                                        @continue
    
                                                    @elseif($moduloAnterior+$modulo<$horario->modulo_inicio)
                                                    
                                                        
                                                        <td class="border px-4 py-2">
                                                         
    
                                                           
    
                                                        </td>
    
                                                    @endif
                                                    
                                                @endforeach
    
    
                                            @endif
                                        @endforeach
                                </tr>
                            @endforeach
    
                    
    
                        </tbody>
              
        
                    </table>
            @endforeach
        @endforeach
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
