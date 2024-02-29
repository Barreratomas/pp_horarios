@extends('layouts.base')

@section('title','comision')

@section('styles')
    
@endsection



@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 

            <a href="{{route('mostrarFormularioComision')}}"style="display: inline-block; margin-right: 10px;">
                <button type="submit" class="btn btn-primary me-2">Crear</button>

            </a>
           
        </div>
    </div>
</div>

<div class="container">
    @foreach ($comisiones as $comision)
    <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px; width:30vw;">
        <p>Comision:      {{ $comision->anio }}°{{$comision->division}}  </p>
        <p>Carrera:   {{ $comision->carrera->nombre }}</p>
        <p>Capacidad:   {{ $comision->capacidad }}</p>
        <div class="botones">

            <a href="{{route('mostrarActualizarComision', $comision->id_comision)}}"style="display: inline-block; margin-right: 10px;">
                <button type="submit" class="btn btn-secondary m-2" 
                >Actualizar</button>
            </a>
                
            
            <form action="{{route('eliminarComision',$comision->id_comision)}}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger" 
                >Eliminar</button>
            </form>
           </div>
 
    </div>
    @endforeach
</div>


<div id="messages-container" class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>

@endsection