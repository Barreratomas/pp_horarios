@extends('layouts.base')

@section('title','crear usuario')

@section('content')
<style>
    .form-check-input{
        border: 1px solid rgba(0, 0, 0, 0.218);

    }

</style>
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('storeUsuario') }}" method="post">
                @csrf

                    <label for="dni">Ingrese el dni</label><br>
                    <input type="number" name="dni"><br><br>                    

                    <label for="nombre">Ingrese el nombre</label><br>
                    <input type="text" name="nombre"><br><br>

                    <label for="apellido">Ingrese el apellido</label><br> <!-- Corregido el texto del label -->
                    <input type="text" name="apellido"><br><br>
                    
                    <label for="tipo">Seleccione el tipo de usuario</label><br> <!-- Corregido el texto del label -->

                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="estudiante" value="estudiante" checked>
                        <label class="form-check-label" for="estudiante">Estudiante</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="profesor" value="docente">
                        <label class="form-check-label" for="docente">Docente</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="bedelia" value="bedelia">
                        <label class="form-check-label" for="bedelia">Bedelia</label>
                    </div><br><br>
                    

                    <label for="email">Ingrese el email</label><br> 
                    <input type="email" name="email"><br><br>

                    
                    <label for="id_carrera" id="label-carrera">Selecciona una carrera:</label>
                    <select name="id_carrera" id="select-carrera">
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre }}</option>
                        @endforeach
                    </select>

                    <label for="id_comision" id="label-comision">Selecciona una comisión:</label>
                    <select name="id_comision" id="select-comision">
                        @foreach ($comisiones->sortBy(['anio', 'division']) as $comision)
                            <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{ $comision->division }}</option>
                        @endforeach
                    </select>
                    
                    <br><br>
                    

                    <button type="submit" class="btn btn-primary me-2">Crear</button> <!-- Agregada clase me-2 para espacio entre botones -->
            </form>

            
        </div>
    </div>
</div>

<div class="container" style="width: 500px;"> <!-- Cambiado a container-fluid -->
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
       
</div>
<script>
    // Función para mostrar u ocultar los campos de selección de carrera y comisión
    function toggleCampos() {
        var tipoUsuario = document.querySelector('input[name="tipo"]:checked').value;
        var labelCarrera = document.getElementById('label-carrera');
        var selectCarrera = document.getElementById('select-carrera');
        var labelComision = document.getElementById('label-comision');
        var selectComision = document.getElementById('select-comision');

        if (tipoUsuario == 'estudiante') {
            labelCarrera.style.display = 'inline';
            selectCarrera.style.display = 'inline';
            labelComision.style.display = 'inline';
            selectComision.style.display = 'inline';
        } else {
            labelCarrera.style.display = 'none';
            selectCarrera.style.display = 'none';
            labelComision.style.display = 'none';
            selectComision.style.display = 'none';
        }
    }

    // Ejecutar la función al cargar la página
    window.onload = toggleCampos;

    // Volver a ejecutar la función cada vez que se cambie el tipo de usuario
    document.querySelectorAll('input[name="tipo"]').forEach(function(radio) {
        radio.addEventListener('change', toggleCampos);
    });
</script>
@endsection
