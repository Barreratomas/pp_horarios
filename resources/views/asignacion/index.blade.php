@extends('layouts.base')

@section('title','asignaciones')

@section('styles')
    
@endsection



@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 

            
           
        </div>
    </div>
</div>

<div class="container">
    @foreach ($docentes as $docente)
        <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px; width:30vw;">
            <p>Nombre: {{ $docente->nombre }} {{ $docente->apellido }}</p>
            <p>DNI: {{ $docente->dni }}</p>
            
            @foreach ($docente->horarioPrevioDocente->zip($docente->docenteMateria) as [$h_p_d, $dm])
                @if ($h_p_d && $dm && $dm->disponibilidad)
                    <div style="border: 1px solid #ccc; border-radius: 5px; padding: 10px; margin-bottom: 10px; width:28.5vw;">
                        @if ($h_p_d->dia !=null)
                        <p>Dia horario previo: {{ $h_p_d->dia }}</p>
                        <p>Hora horaio previo: {{ $h_p_d->hora }}</p>
                        @endif
                        
                        <p>Materia: {{ $dm->materia->nombre }}</p>
                        <p>nombre del aula: {{ $dm->aula->nombre }}</p>
                        <p>Comision: {{ $dm->comision->anio }}°{{ $dm->comision->division }}</p>
                        <p>carrera: {{$dm->comision->carrera->nombre}}</p>
                        
                        <a href="{{ route('mostrarActualizarHPD', ['h_p_d' => $h_p_d->id_h_p_d, 'dm' => $dm->id_dm]) }}" style="display: inline-block; margin-right: 10px;">
                            <button type="submit" class="btn btn-secondary m-2">Actualizar asignación</button>
                        </a>
                        
                        <form action="{{ route('eliminarAsignacion', ['h_p_d' => $h_p_d->id_h_p_d, 'dm' => $dm->id_dm]) }}" method="post" style="display: inline-block;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Eliminar asignación</button>
                        </form>
                    </div>

                @endif
            @endforeach
            

            <div class="botones">
                
                <a href="{{route('mostrarFormularioHPD', $docente->dni)}}"style="display: inline-block; margin-right: 10px;">
                    <button type="submit" class="btn btn-primary me-2">Asignar</button>

                </a>
                
            </div>
    
        </div>
    @endforeach
</div>


<div id="messages-container" class="container">
    @if ($message = session('error'))
    <div class="alert alert-danger">
        {{ $message }}
    </div>
    @php
        session()->forget('error'); 

    @endphp

    @endif


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