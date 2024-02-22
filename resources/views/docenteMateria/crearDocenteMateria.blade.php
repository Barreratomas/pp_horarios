<!-- resources/views/docenteMateria/crearDocenteMateria.blade.php -->

@extends('layouts.base')

@section('title', 'Crear docente')

@section('content')

    <!-- Formulario para crear docente de materia -->
    <form action="{{ route('storeDocenteMateria') }}" method="post">
        @csrf
        <input type="hidden" name="dni_docente" value="{{ session('success.dni') ?? session('dni_docente') ?? session('error.dni_docente')}}">

        

        <label for="materia">Seleccione una materia</label>
        <select name="id_materia">
            @foreach ($materias as $materia)
                <option value="{{ $materia->id_materia }}">{{ $materia->nombre }}</option>
            @endforeach
        </select>

        <br>
        <label for="comision">Seleccione una comision</label>
        <select name="id_comision">
            @foreach ($comisiones as $comision)
                <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{$comision->division}}</option>
            @endforeach
        </select>

        <br>
        <label for="aula">Seleccione un aula</label>
        <select name="id_aula">
            @foreach ($aulas as $aula)
                <option value="{{ $aula->id_aula }}">{{ $aula->nombre }}</option>
            @endforeach
        </select>
        <br>

        <button type="submit">Siguiente</button>
    </form>

        @if(session('success'))
        <p>El DNI es: {{ session('success.dni_docente') }}</p>
    @elseif(session('error'))
        <p>El DNI es: {{ session('error.dni_docente') }}</p>
    @endif
        
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection
