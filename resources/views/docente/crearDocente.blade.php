@extends('layouts.base')

@section('title','crear docente')

@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('storeDocente') }}" method="post">
                @csrf
                <label for="dni">Ingrese el DNI</label><br>
                <input type="number" name="dni" id="dniInput" placeholder="00000000"><br><br>
                @error('dni')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="nombre">Ingrese el nombre</label><br>
                <input type="text" name="nombre"><br><br>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <label for="apellido">Ingrese el apellido</label><br> <!-- Corregido el texto del label -->
                <input type="text" name="apellido"><br><br>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                <label for="email">Ingrese el email</label><br>
                <input type="email" name="email"><br><br>
                @error('nombre')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
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
