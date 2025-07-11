<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedro Gual</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <!-- CSS personalizado -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
</head>
<body>
    <div class="container-fluid">
        <!-- Barra superior -->
     @auth
        <div class="row bg-light py-2 align-items-center border-bottom" id="div-search">
            <div class="col-2 d-md-none">
                <button id="toggleSidebar" class="btn btn-outline-secondary btn-sm">
                    ☰
                </button>
            </div>
            <div class="col-10 col-md-12">
                <form class="d-flex w-100" role="search" method="get" action="{{route('profile.search')}}">
                    <input class="form-control form-control-sm me-2 input-search" type="search" placeholder="Buscar..." aria-label="Buscar" name="search_user">
                    <button class="btn btn-sm btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

        </div>

        <div class="row">
            <!-- Sidebar izquierdo -->
           
            <div id="sidebar" class="col-md-2 col-lg-2 bg-dark sidebar vh-100 sticky-top d-none d-md-block">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item mb-4">
                            <a class="nav-link text-white" href="#">                               
                                <img src="{{ asset('img/Logo_Blanco.png') }}" alt="Usuario" width="75px" height="75px" class="text-center">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white active" href="{{ route('inicio') }}">
                                <i class="fas fa-home mr-2"></i> Inicio
                            </a>
                        </li>
                        
                        <!--<li class="nav-item">
                            <a class="nav-link text-white" href="#">
                                <i class="fas fa-bell mr-2"></i> Notificaciones
                            </a>
                        </li>-->
                        
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('profile', ['username' => Auth::user()->id]) }}">
                                <i class="fas fa-user mr-2"></i> Perfil
                            </a>
                        </li>
                        
                    </ul>
                    
                    <!--<button class="btn btn-primary btn-block rounded-pill mt-3">Publicar</button>-->
                    
                    <div class="dropdown mt-5">
                        <a class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" href="#" id="dropdownUser1" data-toggle="dropdown" aria-expanded="false">
               
                            <img src="{{ Auth::user()->photo ? asset('profile/photos/'.Auth::user()->photo) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=random' }}" 
                                alt="{{ Auth::user()->username }}" 
                                width="32" 
                                height="32" 
                                class="rounded-circle mr-2">
                            <strong>{{ Auth::user()->username }}</strong>
                        </a>
                        <div class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <a class="dropdown-item" href="{{ route('profile', ['username' => Auth::user()->id]) }}">Perfil</a>
                            <!--<a class="dropdown-item" href="#">Configuración</a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>

                            <!-- Formulario oculto para el logout -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endauth

            <!-- Contenido principal -->
            <main role="main" class="col-md-10 col-lg-10 px-md-4 py-4" id="mainContent">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Mostrar/ocultar sidebar en móvil
        $('#toggleSidebar').on('click', function () {
            $('#sidebar').toggleClass('d-none');
        });
    </script>

    @yield('scripts')
</body>
</html>