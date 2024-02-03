@extends('layouts.base')
@section('title','Horario')
    
@section('content')
<form action="{{ route('mostrarHorario') }}" method="post">
    @csrf
    <label for="comision">Selecciona una comisión:</label>
    <select name="comision">
        @foreach ($comisiones->sortBy(['anio', 'division']) as $comision)
            <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{ $comision->division }}</option>
        @endforeach
    </select>
    @error('comision')
        <p style="color:red">{{$message}}</p>
    @enderror

    <label for="carrera">Selecciona una carrera:</label>
    <select name="carrera">
        @foreach ($carreras as $carrera)
            <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre }}</option>
        @endforeach
    </select>
    @error('carrera')
        <p style="color:red">{{$message}}</p>
    @enderror

    <button type="submit">Mostrar Horario</button>
</form>




  

    


@endsection
