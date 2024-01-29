<!-- En tu vista horario.blade.php -->

@extends('layouts.base')

@section('title', 'horario')

@section('content')
    <p>Lista de comisiones</p>

    <form action="{{ route('mostrarHorarios') }}" method="post">
        @csrf
        <label for="comision">Selecciona una comisión:</label>
        <select name="comision" id="comision">
            @foreach ($comisiones->sortBy(['anio', 'division']) as $comision)
                <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{ $comision->division }}</option>
            @endforeach
        </select>
        <button type="submit">Mostrar Comisión</button>
    </form>

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
                @foreach ($horarios as $horario)
                    <tr>
                        <td>{{ $horario->dia }}</td>
                        <td>{{ $horario->hora_inicio }}</td>
                        <td>{{ $horario->hora_fin }}</td>
                        <td>{{ $horario->aula ? $horario->aula->nombre : 'N/A' }}</td>
                        <td>{{ $horario->docenteMateria ? $horario->docenteMateria->materia->nombre : 'N/A' }}</td>
                        <td>{{ $horario->comision ? $horario->comision->anio : 'N/A' }}°{{ $horario->comision ? $horario->comision->division : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection



