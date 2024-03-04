<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

    </style>
</head>
<body>
    <h1>Hola {{$nombre}}</h1>
    <p>Tus horarios fueron asignados, inicie sesion para verlos</p>
    <a href="http://127.0.0.1:8000/">LOGIN</a>
</body>
</html>

{{-- @component('mail::message')
# Asignado a un horario

Usted fue asignado a un horario. Por favor, ingrese a la página para verlo.

Gracias,<br>
{{ config('app.name') }}
@endcomponent --}}