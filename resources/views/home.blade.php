@extends('layouts.base')

@section('title','home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')


<div class="container py-3">
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
   



    <!-- Mostrar el tipo de usuario -->
    <div class="user-type">
        
        @if(session('userType'))
            <p style="color:red;">Tipo de usuario: {{ session('userType') }}</p>
        @endif
    </div>
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


