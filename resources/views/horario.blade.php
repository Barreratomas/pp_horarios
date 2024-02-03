@php
    $hideMenu = true;
@endphp
@extends('layouts.base')

@section('title', 'horario')

@section('content')

{!! $formularioHorarioPartial !!} 

<p>id de Comisión encontrada: {{ $id_comision }}</p>

@include('layouts.parcials.table')
    
@endsection



