
<div class="button-container">
    <button id="toggleButton" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i> 
    </button>
</div>

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
                <!-- agregar mas -->
            </ul>
        </div>
    </nav>
</div>