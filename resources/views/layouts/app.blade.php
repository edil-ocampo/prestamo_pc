<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/sena-logo.svg')}}" type="image/svg">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @yield('style')
    <title>@yield('title', 'Sistema de Préstamos SENA')</title>
</head>
<body>
    <div class="layout-container">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <img src="{{ asset('img/logoSenaa.png')}}" alt="logo-sena">
                </div>
                <h3>Sistema de Préstamos</h3>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('index') }}" class="nav-link">
                            <i class="fas fa-home"></i>
                            <span>Inicio</span>
                        </a>
                    </li>

                    <li class="nav-category">
                        <span>Préstamos Aprendices</span>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('entregar.aprendiz')}}" class="nav-link">
                            <i class="fas fa-check-circle"></i>
                            <span>Entregar préstamo</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('vistaPrestamoAprendiz')}}" class="nav-link">
                            <i class="fa fa-notes-medical"></i>
                            <span>Agregar componente</span>
                        </a>
                    </li>

                    <li class="nav-category">
                        <span>Préstamos Instructores</span>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('entregar.instructor')}}" class="nav-link">
                            <i class="fas fa-check-circle"></i>
                            <span>Entregar préstamo</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('index.form.instructor') }}" class="nav-link">
                            <i class="fa fa-notes-medical"></i>
                            <span>Agregar componente</span>
                        </a>
                    </li>

                    <li class="nav-category">
                        <span>Consultas</span>
                    </li>
                    <li class="nav-item dropdown-container">
                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="fas fa-calendar-day"></i>
                            <span>Préstamos de hoy</span>
                            <i class="fas fa-chevron-right dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('index.prestamosAprendizAlDia') }}">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Aprendices</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('index.prestamosInstructorAlDia') }}">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Instructores</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown-container">
                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="fas fa-history"></i>
                            <span>Historial</span>
                            <i class="fas fa-chevron-right dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('index.prestamosAprendiz') }}">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Aprendices</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('index.prestamosInstructor') }}">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Instructores</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('index.prestamosGeneral') }}">
                                    <i class="fas fa-users"></i>
                                    <span>Todos</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown-container">
                        <a href="#" class="nav-link dropdown-toggle">
                            <i class="fas fa-filter"></i>
                            <span>Filtrar por fecha</span>
                            <i class="fas fa-chevron-right dropdown-icon"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('buscar.aprendiz') }}">
                                    <i class="fas fa-user-graduate"></i>
                                    <span>Aprendices</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buscar.instructor') }}">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>Instructores</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('buscar.general') }}">
                                    <i class="fas fa-users"></i>
                                    <span>Todos</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <div class="main-content">
            <header class="top-header">
                <div class="header-left">
                    <button id="sidebar-toggle" class="sidebar-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2 class="page-title">@yield('title-section','')</h2>
                </div>
                <div class="header-right">
                    <div class="datetime-display" id="fecha-hora-actual">
                        <!-- Fecha y hora se insertarán con JavaScript -->
                    </div>
                </div>
            </header>

            <main class="content-area">
                <div class="content-header">
                    @yield('total-prestamos')
                </div>
                <div class="content-body">
                    @yield('content')
                </div>
            </main>

            <footer class="footer">
                <p>&copy; {{ date('Y') }} Sistema de Préstamos SENA | Desarrollado por <span class="developer">Edilberto Ocampo</span></p>
            </footer>
        </div>
    </div>

    @yield('script')
    <script src="{{ asset('js/app.js')}}"></script>
    <script src="{{ asset('js/sweetalert.js')}}"></script>
</body>
</html>
