<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo') - Warmi'A </title>
    {{-- boostrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    {{-- boxicons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{-- fuente letra --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,600&display=swap" rel="stylesheet">

    @yield('style')
</head>
<body class="">
  
      <div class="main-container d-flex">
        {{-- inicio dashboard --}}
        <div class="sidebar" id="side_nav">
            <div class="header-box pt-3 px-4 pb-4 d-flex justify-content-between">
                {{-- logo --}}
                <h1 class="fs-4">
                    <img class="logo" src="{{ asset('img/logo-app.jpg') }}" alt="">
                </h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa fa-bars"></i></button>
            </div>
            <ul class="list-unstyled px-2">
                <li class="{{ request()->is('/dashboard/homeDashboard') ? 'active' : '' }}">
                    <a href="/dashboard/homeDashboard" class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa fa-home"></i>
                        Inicio
                    </a>
                </li>

                <hr class="h-color mx-2">
                <p class="px-3 d-block">Control</p>
                <li class="{{ request()->is('dashboard/gestion-citas') ? 'active' : '' }}">
                    <a href="/dashboard/gestion-citas" class="text-decoration-none px-3 py-2 d-block">
                    <i class="fa fa-list"></i>
                    Gestion de Citas</a>
                </li>
                <li class="{{ request()->is('dashboard/gestion-pacientes') ? 'active' : '' }}">
                    <a href="/dashboard/gestion-pacientes" class="text-decoration-none px-3 py-2 d-block">
                    <i class="fa fa-list"></i>
                    Gestion de Pacientes</a>
                </li>
                <hr class="h-color mx-2">
                <p class="px-3 d-block">Gestion</p>
                
                <li class="{{ request()->is('dashboard/calendario-citas') ? 'active' : '' }}">
                    <a href="/dashboard/calendario-citas" class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa fa-calendar"></i>
                        Calendario de Citas</a>
                </li>
                <li class="{{ request()->is('dashboard/notificacion-citas') ? 'active' : '' }}">
                    <a href="/dashboard/notificacion-citas" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fa fa-bell"></i> Notificaciones</span>
                  <span class="bg-dark rounded-pill text-white py-0 px-2">02</span>
                    </a>
                </li>
                <li class="">
                    <a href="#" class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa fa-search"></i>
                        Busqueda Rapida</a>
                </li>
            </ul>
            <hr class="h-color mx-2">
            <p class="px-3 d-block">Cargo :</p>
            <ul class="list-unstyled px-2">
                <li class="">
                    <a href="#" class="text-decoration-none px-2 py-2 d-block">
                        Recepcionista
                    </a>
                </li>
                <hr class="h-color mx-2">
                <li class="">
                    <a href="#" class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Cerrar Sesion
                    </a>
                </li>

            </ul>

        </div>
            {{-- Fin dashboard --}}
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                     <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span class="bg-dark rounded px-2 py-0 text-white">CL</span></a>
                       
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fal fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Nombres: Isaias Antonio Mayhuay Maquera</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Cerrar sesion</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <main class="dashboard-content px-3 pt-4">
                <h4>@yield('titulo')</h4>
                @yield('contenido')
            </main>
      </div>
  </div>
        
       
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>