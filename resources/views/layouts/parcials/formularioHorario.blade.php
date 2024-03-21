
@extends('layouts.base')
@section('title','Horario')


    
@section('content')
<div class="container py-3">
    <div class="row align-items-center justify-content-center">
        <div class="col-6 text-center"> 

    
            <form action="{{ route('mostrarHorario') }}" method="post">
                @csrf
                <div class="mb-3"> <label for="comision" style="font-family: sans-serif">Selecciona una comisión:</label>
                    
                  <select class="form-select" name="comision" aria-label="Comisión">
                      @foreach ($comisiones->sortBy(['anio', 'division']) as $comision)
                        <option value="{{ $comision->id_comision }}">
                          {{ $comision->anio }}°{{ $comision->division }} | {{ $comision->carrera->nombre }}
                        </option>
                      @endforeach
                    </select>
                    @error('comision')
                      <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
               

               


                <button type="submit" class="btn btn-primary me-2">Mostrar Horario</button>
            </form>
   
        </div>
    </div>
</div>


@endsection
