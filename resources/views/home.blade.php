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


@endsection


