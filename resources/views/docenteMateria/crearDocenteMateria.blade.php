@extends('layouts.base')

@section('title', 'Crear docente')

@section('content')


<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('storeDocenteMateria',$docente->dni) }}" method="post">
                @csrf


                <label for="id_materia">Seleccione una materia</label>
                <select name="id_materia">
                    @foreach ($materias as $materia)
                        <option value="{{ $materia->id_materia }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
                @error('id_materia')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <br><br>

                
                <label for="id_comision">Seleccione una comision</label>
                <select name="id_comision">
                    @foreach ($comisiones as $comision)
                        <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{$comision->division}}</option>
                    @endforeach
                </select>
                @error('id_comision')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <br><br>

                
                <label for="id_aula">Seleccione un aula</label>
                <select name="id_aula">
                    @foreach ($aulas as $aula)
                        <option value="{{ $aula->id_aula }}">{{ $aula->nombre }}</option>
                    @endforeach
                </select>
                @error('id_aula')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <br><br>

                <button type="submit" class="btn btn-primary me-2">Siguiente</button> 
            </form>
            
        </div>
    </div>
</div>

                
                
                
    




    
        
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
