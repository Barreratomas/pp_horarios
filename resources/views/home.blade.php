@extends('layouts.base')

@section('title','home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')


<div class="container">
    <div class="info">
        <h1>Terciario Urquiza</h1>
        <p>Bv. Oroño 690 – Rosario – Santa Fe – Argentina</p>
    </div>
    
   
    <div class="banner">
        <img src="{{asset('images/banner-escuela.jpg')}}">
      
        
    </div>


    <div class="novedades">
        <h2>Novedades</h2>
        <img src="{{asset('images/novedades.jpg')}}">

    </div>
</div>

{{-- <main>
    <section class="banner">
        <img src="banner.jpg" alt="Imagen de fondo">
        <h1>Título del banner</h1>
        <p>Descripción del banner</p>
    </section>
    <section class="tarjetas">
        <div class="tarjeta">
            <h2>Título de la tarjeta 1</h2>
            <p>Descripción de la tarjeta 1</p>
        </div>
        <div class="tarjeta">
            <h2>Título de la tarjeta 2</h2>
            <p>Descripción de la tarjeta 2</p>
        </div>
        <div class="tarjeta">
            <h2>Título de la tarjeta 3</h2>
            <p>Descripción de la tarjeta 3</p>
        </div>
    </section>
</main>
<footer>
    <p>Información de contacto</p>
</footer> --}}
@endsection


