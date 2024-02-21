@extends('layouts.base')

@section('title','crear docente')

@section('content')
    <form action="{{ route('storeDocente') }}" method="post">
        @csrf
        <label for="dni">Ingrese el DNI</label><br>
        <input type="number" name="dni" id="dniInput" placeholder="00000000"><br><br>

        <label for="nombre">Ingrese el nombre</label><br>
        <input type="text" name="nombre"><br><br>

        <label for="apellido">Ingrese el nombre</label><br>
        <input type="text" name="apellido"><br><br>

        <label for="email">Ingrese el email</label><br>
        <input type="email" name="email"><br><br>

        <button>siguiente</button>
    </form>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


@endsection