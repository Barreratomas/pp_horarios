<p>Lista de comisiones</p>

<form action="{{ route('mostrarHorarios') }}" method="post">
    @csrf
    <label for="comision">Selecciona una comisión:</label>
    <select name="comision">
        @foreach ($comisiones->sortBy(['anio', 'division']) as $comision)
            <option value="{{ $comision->id_comision }}">{{ $comision->anio }}°{{ $comision->division }}</option>
        @endforeach
    </select>
    @error('comision')
        <p style="color:red">{{$message}}</p>
        
    @enderror
    <button type="submit">Mostrar Comisión</button>
</form>