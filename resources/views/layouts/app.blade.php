
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    <!--Fontawesone CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!--SweetAlert CDN-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('style')
    <title>@yield('title','')</title>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                
                <img src="{{ asset('img/logoSenaa.png')}}" alt="logo-sena">
            </div>
            <div class="fecha-hora">
                <h4 id="fecha-hora-actual"></h4>
            </div>
        </div>
    </header>
    <main>
        <aside class="barra-lateral">
            <h2>Barra de navegación</h2>
            <nav>
                <ul>
                    <li><a href="{{ route('index') }}" class="nav-link"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="{{ route('entregar.aprendiz')}}" class="nav-link"><i class="fas fa-check-circle"></i> Entregar préstamo apréndiz</a></li>
                    <li> <a href="{{ route('vistaPrestamoAprendiz')}}" class="nav-link"><i class="fa fa-notes-medical"></i>&nbsp;Agregar componente apréndiz</a></li>
                    <li><a href="{{ route('entregar.instructor')}}" class="nav-link"><i class="fas fa-check-circle"></i> Entregar préstamo instructor</a></li>
                    <a href="{{ route('vistaPrestamoInstructor') }}" class="nav-link"><i class="fa fa-notes-medical"></i>&nbsp;Agregar componente instructor</a>
                    <li></li>
                    <li class="dropdown-container">
                        <a href="#" id="prestamos-hoy-dropdown" class="nav-link">
                            <i class="fas fa-chevron-down"></i> Ver préstamos de hoy
                        </a>
                        <ul class="dropdown-menu" id="prestamos-hoy-menu">
                            <li><a href="{{ route('index.prestamosAprendizAlDia') }}"><i class="fas fa-calendar-day"></i>&nbsp; Aprendices</a></li>
                            <li><a href="{{ route('index.prestamosInstructorAlDia') }}"><i class="fas fa-calendar-day"></i>&nbsp; Instructores</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-container">
                        <a href="#" id="prestamos-dropdown" class="nav-link">
                            <i class="fas fa-chevron-down"></i> Historial de préstamos
                        </a>
                        <ul class="dropdown-menu" id="prestamos-menu">
                            <li><a href="{{ route('index.prestamosAprendiz') }}"><i class="fas fa-file-archive"></i> Lista aprendices</a></li>
                            <li><a href="{{ route('index.prestamosInstructor') }}"><i class="fas fa-file-archive"></i> Lista instructores</a></li>
                            <li><a href="{{ route('index.prestamosGeneral') }}"><i class="fas fa-file-archive"></i> Lista de ambos</a></li>
                        </ul>
                    </li>
                    <li class="dropdown-container">
                        <a href="#" id="historial-dropdown" class="nav-link">
                            <i class="fas fa-chevron-down"></i> Filtrar préstamos por fecha
                        </a>
                        <ul class="dropdown-menu" id="historial-menu">
                            <li><a href="{{ route('buscar.aprendiz') }}"><i class="fas fa-chart-bar"></i> Préstamos aprendices</a></li>
                            <li><a href="{{ route('buscar.instructor') }}"><i class="fas fa-chart-bar"></i> Préstamos instructores</a></li>
                            <li><a href="{{ route('buscar.general') }}"><i class="fas fa-chart-bar"></i> Préstamos de ambos</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>
        <section class="visualizacion">
            <h2 class="title-section">@yield('title-section','')</h2>
            <div>
                @yield('total-prestamos')
            </div>
            @yield('content')
        </section>
    </main>
    @yield('script')
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/sweetalert.js')}}"></script>
</body>
</html>