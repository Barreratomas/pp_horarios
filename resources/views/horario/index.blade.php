@php
    $hideMenu = true;
@endphp
@extends('layouts.base')

@section('title', 'horario')

@section('content')

{!! $formularioHorarioPartial !!} 
<div class="container">
    <div class="row">

@include('layouts.parcials.table')
</div>
</div>

@endsection



