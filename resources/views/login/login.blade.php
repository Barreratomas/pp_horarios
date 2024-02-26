<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .login-form {
            width: 350px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .login-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .mb-3 input {
            border: 1px solid rgba(0, 0, 0, 0.218);
        }

        .login-form .form-label {
            color: #555;
        }

        .login-form .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .login-form .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .login-form .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .login-form .forgot-password a {
            color: #0069d9;
            text-decoration: none;
        }

        .login-form .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2 class="mb-4">Inicio de sesión</h2>
        <form action="{{ route('home') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3 d-flex align-items-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="userType" id="estudiante" value="estudiante" checked>
                    <label class="form-check-label" for="estudiante">Estudiante</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="userType" id="profesor" value="profesor">
                    <label class="form-check-label" for="profesor">Profesor</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="userType" id="bedelia" value="bedelia">
                    <label class="form-check-label" for="bedelia">Bedelia</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
        <div class="forgot-password">
            <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</body>
</html>

