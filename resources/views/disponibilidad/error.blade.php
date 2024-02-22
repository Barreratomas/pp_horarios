error dispo


{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}



{{-- Dentro de tu vista 'redireccionarDisponibilidadError.blade.php' --}}
@if($params)
    <p>Parámetros:</p>
    <ul>
        @foreach($params as $key => $value)
            <li>{{ $key }}: {{ $value }}</li>
        @endforeach
    </ul>
@endif
