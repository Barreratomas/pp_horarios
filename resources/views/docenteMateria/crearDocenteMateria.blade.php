<!-- resources/views/docenteMateria/crearDocenteMateria.blade.php -->

@extends('layouts.base')

@section('title', 'Crear docente')

@section('content')

    <!-- Formulario para crear docente de materia -->
    <form action="{{ route('storeDocenteMateria') }}" method="post">
        @csrf
        <input type="hidden" name="dni_docente" value="{{ session('success.dni') }}">

        <label for="materia">Seleccione una materia</label>
        <select name="id_materia">
            @foreach ($materias as $materia)
                <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Siguiente</button>
    </form>

    <!-- Mostrar mensajes -->
    @if(session('success'))
        <p>{{ session('success.message') }}</p>
    @elseif(session('error'))
        <p>{{ session('error.message') }}</p>
    @endif

@endsection
