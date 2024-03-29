<link rel="stylesheet" href="{{ asset('css/menu.css') }}">


    <!-- Aquí vamos a colocar el botón dentro del mismo div que el menú -->
    <div class="button-container">
        <button id="toggleButton" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i> 
        </button>
    </div>

    <!-- Aquí está el menú colapsable -->
    <div class="collapse" id="sidebar">
        <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar vh-100 " style="width: 250px;" id="miDiv">
            <div class="position-sticky cont-nav">
                <ul class="nav flex-column">
                    
                    {{-- AGREGAR CONDICIONALES A LAS RUTAS QUE SOLO PUEDE ENTRAR BEDELIA --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">home</a>
                    </li>
                        {{-- estudiante --}}
                    @if (Session::get('userType') == 'estudiante')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mostrarFormularioHorario') }}">horarios</a>
                        </li>
                    @endif

                        {{-- docente --}}
                    @if (Session::get('userType') == 'docente')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('formularioHorarioDocente') }}">horarios</a>
                        </li>
                    @endif
                        {{-- bedelia --}}
                    @if (Session::get('userType') == 'bedelia' || Session::get('userType') == 'admin')
                        {{-- admin --}}
                        @if (Session::get('userType') == 'admin')
                            {{--estudiante  --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('mostrarFormularioHorario') }}">horarios estudiante</a>
                            </li>
                            {{-- docente --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('formularioHorarioDocente') }}">horarios docentes</a>
                            </li>
                        @endif
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('mostrarHorarioBedelia') }}">horarios bedelia</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('indexAula')}}">aulas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('indexMateria')}}">materias</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('indexCarrera')}}">carreras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('indexComision')}}">comisiones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('indexUsuario')}}">usuarios</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('indexDocente')}}">docentes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('indexAsignacion')}}">asignacion docente</a>
                        </li>
                    @endif
                   
                    
                    
                </ul>
                <div class="logout">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <button type="button" class="btn btn-danger">Logout</button>
                    </a>
                </div>
                <div class="userType">
                    @if(session('userType'))
                    <p style="color:red;">Tipo de usuario: {{ session('userType') }}</p>
                    @endif
                </div>
            </div>
        </nav>
    </div>
   


<script src="{{ asset('js/menu.js') }}"></script>
