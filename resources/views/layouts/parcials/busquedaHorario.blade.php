<p>Lista de comisiones</p>

<form action="{{ route('mostrarHorarios') }}" method="post">
    @csrf
    <label for="comision">Selecciona una comisión:</label>
    <select name="comision" id="comision">
        @foreach ($comisiones as $comision)
            <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{ $comision->division }}</option>
        @endforeach
    </select>
    <button type="submit">Mostrar Horarios</button>
</form>

@if(isset($comision))
    <p>Horarios para la comisión: {{ $comision->anio }}°{{ $comision->division }}</p>
@endif
