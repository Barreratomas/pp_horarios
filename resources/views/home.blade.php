@extends('layouts.base')

@section('title','home')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('content')

    <div class="bedelia-home">
        <section class="section">
            <div class="izquierda">
                <div class="logo-wrapper">
                    <div class="logo">
                        <div class="logo-display-parent">
                            <div class="logo-display"></div>
                            <img
                                class="logo1-1-icon"
                                loading="lazy"
                                alt=""
                                src="{{ asset('images/home/logoUrquiza.png') }}"
                            />
                        </div>
                    </div>
                </div>
                <div class="carreras">
                    <div class="af">
                        <img
                            class="image-5-icon"
                            loading="lazy"
                            alt=""
                            src="{{ asset('images/home/AF.png') }}"
                        />
                    </div>
                    <div class="ds">
                        <img
                            class="image-4-icon"
                            loading="lazy"
                            alt=""
                            src="{{ asset('images/home/DS.png') }}"
                        />
                    </div>
                    <div class="iti">
                        <img
                            class="image-6-icon"
                            loading="lazy"
                            alt=""
                            src="{{ asset('images/home/ITI.png') }}"
                        />
                    </div>
                </div>
            </div>
            <div class="derecha">
                <div class="titulo-wrapper">
                    <h1 class="titulo">Planilla Horaria</h1>
                </div>
                <div class="subtitulo-parent">
                    <h1 class="subtitulo">Propósito</h1>
                    <b class="parrafo">
                        <p class="en-este-sitio">
                            En este sitio te brindaremos la planificacion horaria tanto para
                            alumnos como para docentes, brindandote asi los horarios
                            deacuerdo a cada comision y carrera pertinente.
                        </p>
                        <p class="mejorando-asi-todo">
                            Mejorando asi todo el sistema de horarios de cursada y aumentado
                            tambien la eficiencia para los Docentes como tambien para los
                            alumnos.
                        </p>
                    </b>
                </div>
                <div class="derecha-inner">
                    <div class="boton-parent">
                        <button class="boton">
                            <div class="button">Ver mas</div>
                        </button>
                        <div class="wrapper-flechaabajo-wrapper">
                            <div class="wrapper-flechaabajo">
                                <img
                                    class="flechaabajo-icon"
                                    loading="lazy"
                                    alt=""
                                    src="{{ asset('images/home/FlechaAbajo.png') }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section1">
            <div class="title-paragraph-button">
                <div class="frame-parent">
                    <div class="titulo-parent">
                        <h1 class="titulo1">Carga de la base de datos alumnos</h1>
                        <div class="parrafo1">
                            Permite cargar a los estudiantes de las diferentes carreras,
                            posibilitando asi mejorar con el sistema de planificacion
                            horaria.
                        </div>
                    </div>
                    <button class="boton1">
                        <div class="subir">Subir</div>
                    </button>
                </div>
            </div>
            <div class="derecha1">
                <div class="pantalla">
                    <div class="barra">
                        <img
                            class="circulitos-icon"
                            loading="lazy"
                            alt=""
                            src="{{ asset('images/home/circulitos.png') }}"
                        />
                    </div>
                    <div class="hombre-wrapper">
                        <img
                            class="hombre-icon"
                            loading="lazy"
                            alt=""
                            src="{{ asset('images/home/Hombre.png') }}"
                        />
                    </div>
                </div>
            </div>
        </section>
        <section class="section2">
            <div class="inner">
                <div class="titulo-group">
                    <h1 class="titulo2">Docentes para comiciones</h1>
                    <div class="parrafo2">
                        Permite cargar a los docentes en la comision que les corresponde,
                        logrando asi mejorar la eficiencia de la planificacion horaria
                    </div>
                    <div class="boton-wrapper">
                        <button class="boton2">
                            <div class="subir1">Subir</div>
                        </button>
                    </div>
                </div>
            </div>
            <div class="pantalla1">
                <div class="barra1">
                    <img
                        class="circulitos-icon1"
                        loading="lazy"
                        alt=""
                        src="{{ asset('images/home/circulitos.png') }}"
                    />
                </div>
                <div class="mujer-wrapper">
                    <img
                        class="mujer-icon"
                        loading="lazy"
                        alt=""
                        src="{{ asset('images/home/Mujer.png') }}"
                    />
                </div>
            </div>
        </section>
        <section class="section3">
            <div class="pantalla2">
                <div class="barra2">
                    <img
                        class="circulitos-icon2"
                        loading="lazy"
                        alt=""
                        src="{{ asset('images/home/circulitos.png') }}"
                    />
                </div>
                <div class="pantalla-inner">
                    <div class="grilla-parent">
                        <div class="grilla">
                            <div class="filas">
                                <div class="filas-child"></div>
                                <div class="filas-item"></div>
                                <div class="logo-container"></div>
                                <div class="carras-c-f-r-a-m-e"></div>
                                <div class="filas-inner"></div>
                                <div class="i-t-i-f-r-a-m-e"></div>
                                <div class="pantalla-f-r-a-m-e"></div>
                                <div class="rectangle-div"></div>
                                <div class="filas-child1"></div>
                                <div class="filas-child2"></div>
                                <div class="filas-child3"></div>
                                <div class="filas-child4"></div>
                                <div class="filas-child5"></div>
                                <div class="filas-child6"></div>
                                <div class="filas-child7"></div>
                                <div class="filas-child8"></div>
                                <div class="filas-child9"></div>
                                <div class="filas-child10"></div>
                                <div class="filas-child11"></div>
                                <div class="filas-child12"></div>
                            </div>
                            <div class="rectangle-parent">
                                <div class="frame-child"></div>
                                <div class="frame-item"></div>
                            </div>
                        </div>
                        <div class="calendario-wrapper">
                            <img
                                class="calendario-icon"
                                loading="lazy"
                                alt=""
                                src="{{ asset('images/home/Calendario.png') }}"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="child">
                <div class="titulo-container">
                    <h1 class="titulo3">Aulas</h1>
                    <div class="parrafo-parent">
                        <div class="parrafo3">
                            Permite ver la planificacion horaria distribuida en un
                            calendario academico en el cual tanto los docentes como los
                            alumnos se podran guiar deacuerdo a su horas pactadas
                        </div>
                        <button class="boton3">
                            <div class="revisar">Revisar</div>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="section4">
            <div class="transparencia">
                <div class="titulo-frame">
                    <h1 class="titulo4">Consultas</h1>
                </div>
                <div class="parrafo-wrapper">
                    <div class="parrafo4">
                        Si tienes alguna consulta no dudes en escribirnos aca abajo o en
                        nuestras redes
                    </div>
                </div>
                <div class="pantalla3">
                    <div class="barra3">
                        <img
                            class="circulitos-icon3"
                            loading="lazy"
                            alt=""
                            src="{{ asset('images/home/circulitos.png') }}"
                        />
                    </div>
                    <div class="pantalla-child">
                        <div class="frame-group">
                            <div class="name-and-last-name-field-parent">
                                <div class="name-and-last-name-field">
                                    <div class="rectangle-group">
                                        <div class="frame-inner"></div>
                                        <div class="nombre">Nombre</div>
                                    </div>
                                    <div class="rectangle-container">
                                        <div class="frame-child1"></div>
                                        <input
                                            class="apellido"
                                            placeholder="Apellido"
                                            type="text"
                                        />
                                    </div>
                                </div>
                                <div class="input-query-box">
                                    <div class="input-query-box-child"></div>
                                    <input class="dni" placeholder="DNI" type="text" />
                                </div>
                            </div>
                            <div class="consulta-parent">
                  <textarea
                      class="consulta"
                      placeholder="Ingrese su consulta"
                      rows="{13}"
                      cols="{68}"
                  >
                  </textarea>
                                <div class="send-button">
                                    <button class="boton4">
                                        <div class="enviar">Enviar</div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<div id="messages-container" class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
</div>

@endsection


