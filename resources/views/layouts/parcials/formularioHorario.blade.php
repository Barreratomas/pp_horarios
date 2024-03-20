
@extends('layouts.base')
@section('title','Horario')


    
@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 

    
            <form action="{{ route('mostrarHorario') }}" method="post">
                @csrf
                <label for="comision">Selecciona una comisión:</label>
                <select name="comision">
                    @foreach ($comisiones->sortBy(['anio', 'division']) as $comision)
                        <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{ $comision->division }}|{{$comision->carrera->nombre}}</option>
                    @endforeach
                </select>
                @error('comision')
                    <p style="color:red">{{$message}}</p>
                @enderror

               


                <button type="submit" class="btn btn-primary me-2">Mostrar Horario</button>
            </form>
   
        </div>
    </div>
</div>


@endsection
