@extends('layouts.base')


@section('title','disponibilidad')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

{{-- Aquí podrías mostrar cualquier contenido adicional de la vista de disponibilidad --}}

{{-- Redireccionamiento a la vista de horario --}}
@if(session('success'))
    <script>
        window.location = "{{ route('crearHorario') }}";
    </script>
@endif
@endsection


