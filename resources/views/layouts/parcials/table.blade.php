
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="{{ asset('css/tabla.css') }}" />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap"
    />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap"
    />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600;700&display=swap"
    />
</head>
<body class="bedelia-horario">

    <table class="planilla1">
        <thead class="horarios">

            @php
                $inicio = [
                    1 => '19:20',
                    2 => '20:00',
                    3 => '20:40',
                    4 => '21:30',
                    5 => '22:10',
                    6 => '22:50'
                ];

                $fin = [
                    1 => '20:00',
                    2 => '20:40',
                    3 => '21:20',
                    4 => '22:10',
                    5 => '22:50',
                    6 => '23:30'
                ];



                $dias = [
                    1 => 'lunes',
                    2 => 'martes',
                    3 => 'miercoles',
                    4 => 'jueves',
                    5 => 'viernes'
                ];
            @endphp

            <tr>
                <th class="div">Días / Horarios</th>
                @for($i = 1; $i < 7; $i++)
                    <th class="p{{$i}}">{{$inicio[$i]}} - {{$fin[$i]}}</th>
                @endfor
            </tr>
        </thead>
        <tbody class="martes">

        @foreach ($dias as  $dia)
            <tr >
                <th>{{$dia}}</th>
                @foreach ($horarios as $horario)
                    @if($horario->dia == $dia)
                        @foreach ($inicio as $modulo =>$hora)
                            @if($horario->modulo_inicio <= $modulo && $modulo < $horario->modulo_fin )
                                <td class="thhh">
                                    {{ $modulo }}

                                    <div>{{$horario->disponibilidad->docenteMateria->materia->nombre}}</div>
                                    <div>{{$horario->disponibilidad->docenteMateria->docente->nombre}}</div>
                                    <div>{{$horario->modulo_inicio}}</div>
                                    <div>{{$horario->modulo_fin}}</div>

                                    <div>{{$horario->disponibilidad->docenteMateria->aula->nombre}}</div>

                                </td>

                            @endif
                        @endforeach


                    @endif
                @endforeach
            </tr>
        @endforeach

        </tbody>
    </table>
</body>
</html>

