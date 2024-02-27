<link rel="stylesheet" href="{{ asset('css/menu.css') }}">

<div class="container-fluid main-cont">
    <!-- Aquí vamos a colocar el botón dentro del mismo div que el menú -->
    <div class="button-container">
        <button id="toggleButton" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i> 
        </button>
    </div>

    <!-- Aquí está el menú colapsable -->
    <div class="collapse" id="sidebar">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar vh-100 " style="width: 250px;" id="miDiv">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mostrarFormularioHorario')}}">horarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('mostrarFormularioDocente')}}">docentes</a>
                    </li>
                    <li class="userType">
                        @if(session('userType'))
                        <p style="color:red;">Tipo de usuario: {{ session('userType') }}</p>
                        @endif
                    </li>
                    <!-- agregar mas -->
                </ul>
            </div>
        </nav>
    </div>
   
</div>

<script src="{{ asset('js/menu.js') }}"></script>
