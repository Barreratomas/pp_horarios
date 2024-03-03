@extends('layouts.base')

@section('title','actualizar materia')

@section('content')
    <div class="container py-3">
        <div class="row align-items-center justify-content-center">
            <div class="col-6 text-center"> 
                <form action="{{ route('actualizarHorarioPrevioDocente',$docente->dni) }}" method="post">
                    @method('put')
                    @csrf
                    

                    <label for="nombre">Ingrese el nombre</label><br>
                    <input type="text" name="nombre"><br><br>

                    <label for="modulos_semanales">Ingrese la cantidad de modulos semanales</label><br> <!-- Corregido el texto del label -->
                    <input type="text" name="modulos_semanales"><br><br>

                    

                    
                    <button type="submit" class="btn btn-primary me-2">Siguiente</button> <!-- Agregada clase me-2 para espacio entre botones -->
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
