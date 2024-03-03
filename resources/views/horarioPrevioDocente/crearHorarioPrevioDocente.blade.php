@extends('layouts.base')

@section('title', 'crear docente')

@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 
            <form action="{{ route('storeHPD',$docente->dni) }}" method="post">
                @csrf
                {{-- <input type="hidden" name="dni_docente" value="{{ session('success.dni') ?? session('dni') ?? session('error.dni_docente') }}"> --}}

                <label for="trabajaInstitucion">¿Trabaja en otra institución?</label><br>
                <input type="radio" name="trabajaInstitucion" value="si">
                <label for="trabaja_si">Sí</label><br>
                <input type="radio" name="trabajaInstitucion" value="no" checked>
                <label for="trabaja_no">No</label><br><br>
                
                <div id="mostrarCampos" style="display: none;">
                    <label for="dia">Ingrese el día</label><br>
                    <input type="text" name="dia"><br><br>
                    @error('dia')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    <label for="hora">Ingrese la hora de salida</label><br>
                    <input type="time" name="hora"><br><br>
                    @error('hora')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror   
                </div>

                <button type="submit" class="btn btn-primary me-2">Siguiente</button> 
            </form>
            
        </div>
    </div>
</div>

    {{-- @if(session('success'))
        <p>El DNI es: {{ session('success.dni') }}</p>
    @elseif(session('error'))
        <p>El DNI es: {{ session('error.dni_docente') }}</p>
    @endif --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
