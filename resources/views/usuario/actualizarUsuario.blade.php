@extends('layouts.base')

@section('title','actualizar usuario')

@section('content')
<style>
    .form-check-input{
        border: 1px solid rgba(0, 0, 0, 0.218);
    }
</style>
    <div class="container py-3">
        <div class="row align-items-center justify-content-center">
            <div class="col-6 text-center"> 
                <form action="{{ route('actualizarUsuario',$usuario->dni) }}" method="post">
                    @method('put')
                    @csrf
                    
                    

                    <label for="nombre">Ingrese el nombre</label><br>
                    <input type="text" name="nombre"><br><br>
                    @error('nombre')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="apellido">Ingrese el apellido</label><br>
                    <input type="text" name="apellido"><br><br>
                    @error('apellido')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="tipo">Seleccione el tipo de usuario</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="estudiante" value="estudiante" checked>
                        <label class="form-check-label" for="estudiante">Estudiante</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="bedelia" value="bedelia">
                        <label class="form-check-label" for="bedelia">Bedelia</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="admin" value="admin">
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                    <br><br>
                    @error('tipo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="email">Ingrese el email</label><br> 
                    <input type="email" name="email"><br><br>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <div id="carrera-container">
                        <label for="id_carrera" id="label-carrera">Selecciona una carrera:</label>
                        <select name="id_carrera" id="select-carrera">
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre }}</option>
                            @endforeach
                        </select>
                        @error('id_carrera')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <br><br>
                    </div>

                    <div id="anio-container">
                        <label for="anio">Ingrese el año</label><br> 
                        <input type="number" name="anio"><br><br>
                        @error('anio')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <br><br>

                    <button type="submit" class="btn btn-primary me-2">Actualizar</button> <!-- Agregada clase me-2 para espacio entre botones -->
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
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener el campo de selección de tipo de usuario
            const tipoUsuario = document.querySelectorAll('input[name="tipo"]');
            // Obtener el contenedor del campo de selección de carrera
            const carreraContainer = document.getElementById('carrera-container');
            // Obtener el contenedor del campo de entrada de año
            const anioContainer = document.getElementById('anio-container');

            // Agregar un controlador de eventos 'change' a cada opción del campo de selección de tipo de usuario
            tipoUsuario.forEach(function (radio) {
                radio.addEventListener('change', function () {
                    // Si se selecciona "Bedelia", ocultar el campo de selección de carrera y el campo de entrada de año; de lo contrario, mostrarlos
                    if (this.value != 'estudiante') {
                        carreraContainer.style.display = 'none';
                        anioContainer.style.display = 'none';
                    } else {
                        carreraContainer.style.display = 'block';
                        anioContainer.style.display = 'block';
                    }
                });
            });
        });
    </script>

@endsection
