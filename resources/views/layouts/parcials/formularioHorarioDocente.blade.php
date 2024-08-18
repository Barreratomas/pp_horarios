
@extends('layouts.base')
@section('title','Horario docente')


    
@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('mostrarHorarioDocente') }}" method="post">
                @csrf
                
                <div class="mb-3">
                    <label for="dni"  style="font-family: sans-serif">Ingrese el DNI del docente:</label>
                    <input type="number" class="form-control" name="dni" id="dni">
                    @error('dni')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                
               
                
                <button type="submit" class="btn btn-primary me-2">Mostrar horarios</button> <!-- Agregada clase me-2 para espacio entre botones -->
            </form>

            
        </div>
    </div>
</div>





@endsection
