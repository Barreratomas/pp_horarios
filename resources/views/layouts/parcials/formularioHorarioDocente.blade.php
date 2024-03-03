
@extends('layouts.base')
@section('title','Horario docente')


    
@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('mostrarHorarioDocente') }}" method="post">
                @csrf
                
                <label for="dni">Ingrese el dni</label><br>
                <input type="number" name="dni"><br><br>
                @error('dni')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
               
                
                <button type="submit" class="btn btn-primary me-2">Mostrar horarios</button> <!-- Agregada clase me-2 para espacio entre botones -->
            </form>

            
        </div>
    </div>
</div>





@endsection
