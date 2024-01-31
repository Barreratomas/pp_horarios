
@extends('layouts.base')

@section('title', 'horario')

@section('content')
@include('layouts.parcials.formularioHorario')

    @if(session('comision_encontrada'))
        <p>id de Comisión encontrada: {{ session('comision_encontrada') }}</p>

        <table border="1">
            <thead>
                <tr>
                    <th>Día</th>
                    <th>Hora Inicio</th>
                    <th>Hora Fin</th>
                    <th>Aula</th>
                    <th>Materia</th>
                    <th>Comisión</th>
                </tr>
            </thead>
            <tbody>
                {{-- verifico existen horarios --}}
                @foreach (session('horarios') ?? [] as $horario)
                    <tr>
                        {{-- si no existen los registros muestro na --}}
                        <td>{{ $horario->dia ? $horario->dia : 'N/A' }}</td>
        	            <td>{{ $horario->hora_inicio ? $horario->hora_inicio : 'N/A' }}</td>
                        <td>{{ $horario->hora_fin ? $horario->hora_fin : 'N/A' }}</td>
                        <td>{{ $horario->aula ? $horario->aula->nombre : 'N/A' }}</td>
                        <td>{{ $horario->docenteMateria ? $horario->docenteMateria->materia->nombre : 'N/A' }}</td>
                        <td>{{ $horario->comision ? $horario->comision->anio : 'N/A' }}°{{ $horario->comision ? $horario->comision->division : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection



