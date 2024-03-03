@extends('layouts.base')

@section('title','actualizar usuario')

@section('content')
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


                    <label for="apellido">Ingrese el apellido</label><br> <!-- Corregido el texto del label -->
                    <input type="text" name="apellido"><br><br>
                    @error('apellido')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="tipo">Seleccione el tipo de usuario</label><br> <!-- Corregido el texto del label -->
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="estudiante" value="estudiante" checked>
                        <label class="form-check-label" for="estudiante">Estudiante</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tipo" id="bedelia" value="bedelia">
                        <label class="form-check-label" for="bedelia">Bedelia</label>
                    </div><br><br>
                    @error('tipo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="email">Ingrese el email</label><br> 
                    <input type="email" name="email"><br><br>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    
                    <label for="id_carrera" id="label-carrera">Selecciona una carrera:</label>
                    <select name="id_carrera" id="select-carrera">
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera->id_carrera }}">{{ $carrera->nombre }}</option>
                        @endforeach
                    </select>
                    @error('id_carrera')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

                    <label for="id_comision" id="label-comision">Selecciona una comisión:</label>
                    <select name="id_comision" id="select-comision">
                        @foreach ($comisiones->sortBy(['anio', 'division']) as $comision)
                            <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{ $comision->division }}</option>
                        @endforeach
                    </select>
                    @error('id_comision')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

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

@endsection
