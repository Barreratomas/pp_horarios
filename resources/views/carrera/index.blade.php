@extends('layouts.base')

@section('title','Carreras')

@section('styles')

@endsection
@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <a href="{{route('mostrarFormularioCarrera')}}"style="display: inline-block; margin-right: 10px;">
                <button type="submit" class="btn btn-primary me-2">Crear</button>

            </a>

           
        </div>
    </div>
</div>

<div class="container">
    @foreach ($carreras as $carrera)
    <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px; width:30vw;">
        <p>Carrera: {{ $carrera->nombre }}</p>
        <div class="botones">

            <a href="{{route('actualizarCarrera', $carrera->id_carrera)}}"style="display: inline-block; margin-right: 10px;">
                <button type="submit" class="btn btn-secondary m-2" 
                >Actualizar</button>
            </a>
                
            
            <form action="{{route('eliminarCarrera',$carrera->id_carrera)}}" method="post" style="display: inline-block;">
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
