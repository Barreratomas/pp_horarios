@extends('layouts.base')

@section('title', 'Crear docente')

@section('content')


<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('storeDocenteMateria') }}" method="post">
                @csrf
                <input type="hidden" name="dni_docente" value="{{ session('success.dni') ?? session('dni_docente') ?? session('error.dni_docente')}}">

                <label for="materia">Seleccione una materia</label>
                <select name="id_materia">
                    @foreach ($materias as $materia)
                        <option value="{{ $materia->id_materia }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select><br><br>

                
                <label for="comision">Seleccione una comision</label>
                <select name="id_comision">
                    @foreach ($comisiones as $comision)
                        <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{$comision->division}}</option>
                    @endforeach
                </select><br><br>

                
                <label for="aula">Seleccione un aula</label>
                <select name="id_aula">
                    @foreach ($aulas as $aula)
                        <option value="{{ $aula->id_aula }}">{{ $aula->nombre }}</option>
                    @endforeach
                </select><br><br>

                <button type="submit" class="btn btn-primary me-2">Siguiente</button> 
            </form>
            
        </div>
    </div>
</div>

                
                
                
    




    {{-- @if(session('success'))
        <p>El DNI es: {{ session('success.dni_docente') }}</p>
    @elseif(session('error'))
        <p>El DNI es: {{ session('error.dni_docente') }}</p>
    @endif --}}
        
    <div class="container" style="width: 500px;"> <!-- Cambiado a container-fluid -->

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            
    </div>

@endsection
