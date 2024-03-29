@extends('layouts.base')

@section('title','actualizar docente')

@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('actualizarDocente',$docente->dni) }}" method="post">
                @method('put')
                @csrf
                

                <label for="nombre">Ingrese el nombre</label><br>
                <input type="text" name="nombre"><br><br>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="apellido">Ingrese el apellido</label><br> <!-- Corregido el texto del label -->
                <input type="text" name="apellido"><br><br>
                @error('apellido')
                    <div class="text-danger">{{ $message }}</div>
                @enderror


                <label for="email">Ingrese el email</label><br>
                <input type="email" name="email"><br><br>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <button type="submit" class="btn btn-primary me-2">Actualizar</button> <!-- Agregada clase me-2 para espacio entre botones -->
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
