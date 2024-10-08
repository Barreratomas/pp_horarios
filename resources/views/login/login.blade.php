<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    
</head>
<body>
    <div class="left">
        <img  src="{{asset('images/izquierda.png')}}" alt="">
    </div>

    <div class="login-form">
        <h2 class="mb-4">Inicio de sesión</h2>
        <form action="{{ route('postLogin') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class=" mb-3  d-flex align-items-center">
                <div class="mb-3 opcion_arriba ">
                    <div class="form-check form-check-inline flex-fill">
                        <input class="form-check-input" type="radio" name="userType" id="estudiante" value="estudiante" checked>
                        <label class="form-check-label" for="estudiante">Estudiante</label>
                    </div>
                    <div class="form-check form-check-inline flex-fill">
                        <input class="form-check-input" type="radio" name="userType" id="profesor" value="docente">
                        <label class="form-check-label" for="docente">Docente</label>
                    </div>
                </div>
                
                <div class="mb-3 opcion_abajo">
                    <div class="form-check form-check-inline flex-fill">
                        <input class="form-check-input" type="radio" name="userType" id="bedelia" value="bedelia">
                        <label class="form-check-label" for="bedelia">Bedelia</label>
                    </div>
                    <div class="form-check form-check-inline flex-fill">
                        <input class="form-check-input" type="radio" name="userType" id="admin" value="admin">
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
        <div class="forgot-password">
            <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
    <div class="right">
        <img src="{{asset('images/derecha.png')}}" alt="">

    </div>
    
</body>
</html>
