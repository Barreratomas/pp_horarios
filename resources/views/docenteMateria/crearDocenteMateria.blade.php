@extends('layouts.base')

@section('title','crear docente')

@section('content')
    <form action="{{ route('crearDocente') }}" method="post">
        @csrf
        <label for="dni">Ingrese el DNI</label><br>
        <input type="number" name="dni" id="dniInput" placeholder="00000000"><br><br>

        <label for="nombre">Ingrese el nombre</label><br>
        <input type="text" name="nombre"><br><br>

        <label for="apellido">Ingrese el nombre</label><br>
        <input type="text" name="apellido"><br><br>

        <label for="email">Ingrese el email</label><br>
        <input type="email" name="email"><br><br>
    </form>

    <!-- Formulario 2 -->
    <form  action="{{ route('crearHPD') }}" method="post">
        @csrf
        <input type="hidden" name="dni" id="dniHiddenForm2" value="">

        <label for="trabajaInstitucion">¿Trabaja en otra institución?</label>
        <br>
        <input type="radio"  name="trabajaInstitucion" value="si">
        <label for="trabaja_si">Sí</label>
        <br>
        <input type="radio" name="trabajaInstitucion" value="no">
        <label for="trabaja_no">No</label><br><br>
        
        
        <div id="mostrarCampos" style="display: none;">
            <label for="dia">Ingrese el día</label><br>
            <input type="text" name="dia"><br><br>

            <label for="horaSalida">Ingrese la hora de salida</label><br>
            <input type="time" name="horaSalida"><br><br>
        </div>
    </form>

    <!-- Formulario 3 -->
    <form action="{{ route('crearDocenteMateria') }}" method="post">
        @csrf
        <input type="hidden" name="dni" id="dniHiddenForm3" value="">

        <label for="materia">Seleccione una materia</label>
        <select name="materia">
            @foreach ($materias as $materia)
                <option value="{{$materia->id}}">{{$materia->nombre}}</option>
            @endforeach

        </select>


    </form>
    {{-- <!-- Formulario 4 -->
    <form  action="{{ route('mostrarFormularioDisponibilidad') }}" method="get">
        @csrf
        

    </form>
    <br>
    <label for="tipoDisponibilidad">¿Hacer la disponibilidad manualmente?</label><br>
    <input type="radio" name="tipoDisponibilidad" value="manual" id="manual" onclick="redireccionarManual()">
    <label for="manual">Manual</label><br>
    <input type="radio" name="tipoDisponibilidad" value="automatica" id="automatica">
    <label for="automatica">Automática</label><br><br> --}}



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