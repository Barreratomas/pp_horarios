@extends('layouts.base')

@section('title','actualizar comision')

@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('ActualizarComision', $comision->id_comision) }}" method="post">
                @method('put')
                @csrf
                

                <label for="anio">Ingrese el año</label><br>
                <input type="number" name="anio"><br><br>
                @error('anio')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                

                <label for="division">Ingrese la division</label><br>
                <input type="number" name="division"><br><br>
                @error('division')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <label for="id_carrera">Selecciona una carrera:</label>
                <select name="id_carrera">
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre }}</option>
                    @endforeach
                </select><br><br>

                <label for="capacidad">Ingrese la capacidad</label><br> <!-- Corregido el texto del label -->
                <input type="number" name="capacidad"><br><br>
                @error('capacidad')
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
