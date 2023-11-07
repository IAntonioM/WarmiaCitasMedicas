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
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5/main.css' rel='stylesheet' />

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
                <li class="{{ request()->is('inicio') ? 'active' : '' }}">
                    <a href={{ route('inicio') }} class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa fa-home"></i>
                        Inicio
                    </a>
                </li>
                @role('Recepcionista')
                <hr class="h-color mx-2">
                <p class="px-3 d-block">Control</p>
                <li class="{{ request()->is('cita','cita/*') ? 'active' : '' }}">
                    <a href="{{route('gestionCitas')}}" class="text-decoration-none px-3 py-2 d-block">
                    <i class="fa fa-list"></i>
                    Gestion de Citas</a>
                </li>
                <li class="{{ request()->is('paciente') ? 'active' : '' }}">
                    <a href="{{route('gestionPacientes')}}" class="text-decoration-none px-3 py-2 d-block">
                    <i class="fa fa-list"></i>
                    Gestion de Pacientes</a>
                </li>
                <br>
                <br>
                @endrole
                @role('Medico')
                <hr class="h-color mx-2">
                <p class="px-3 d-block">Documentos </p>
                <li class="{{ request()->is('respaldo-medico','respaldo-medico/crear') ? 'active' : '' }}">
                    <a href="{{route('respaldoMedico')}}" class="text-decoration-none px-3 py-2 d-block">
                    <i class="fa-solid fa-folder-open"></i>
                    Respaldo Medico</a>
                </li>
                <br>
                <br>
                @endrole
                
                <hr class="h-color mx-2">
                <p class="px-3 d-block">Otros</p>
                
                <li class="{{ request()->is('calendario') ? 'active' : '' }}">
                    <a href="{{route("calendarioCitas")}}" class="text-decoration-none px-3 py-2 d-block">
                        <i class="fa fa-calendar"></i>
                        Calendario de Citas</a>
                </li>
                <br>
                <br>
            </ul>
            <hr class="h-color mx-2">
            <ul class="list-unstyled px-2">
                <li class="">
                    <a href="{{route('cerrarSesion')}}" class="text-decoration-none px-3 py-2 d-block">
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
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <p class="nav-link active" aria-current="page">Nombres: {{auth()->user()->nombres}} {{ auth()->user()->apellidos }}</p>
                            </li>
                            <li class="nav-item">
                                <p class="nav-link active" aria-current="page" >Cargo: {{auth()->user()->cargo}} </p>
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
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5/main.js'></script>
    @yield('script')
</body>
</html>