@extends('layouts.base')

@section('title', 'crear docente')

@section('content')
    <form action="{{ route('storeHPD') }}" method="post">
        @csrf
        <input type="hidden" name="dni_docente" value="{{ session('success.dni') }}">

        <label for="trabajaInstitucion">¿Trabaja en otra institución?</label><br>
        <input type="radio" name="trabajaInstitucion" value="si">
        <label for="trabaja_si">Sí</label><br>
        <input type="radio" name="trabajaInstitucion" value="no">
        <label for="trabaja_no">No</label><br><br>

        <div id="mostrarCampos" style="display: none;">
            <label for="dia">Ingrese el día</label><br>
            <input type="text" name="dia"><br><br>

            <label for="hora">Ingrese la hora de salida</label><br>
            <input type="time" name="hora"><br><br>
        </div>

        <button>siguiente</button>
    </form>
    <p>El DNI es: {{ session('success.dni') }}</p>

    <script>
        document.querySelectorAll('input[name="trabajaInstitucion"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var mostrarCampos = document.getElementById('mostrarCampos');
                if (this.value == 'si') {
                    mostrarCampos.style.display = 'block';
                } else {
                    mostrarCampos.style.display = 'none';
                }
            });
        });
    </script>
@endsection
